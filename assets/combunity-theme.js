			// Collapse and expand
jQuery(document).ready(function(){
	
	var ajaxurl = combunity.ajax_url;

	var collapsedComments = []
	
	var collapsedCommentPositions =[]

	jQuery(document.body).on('click', '.combunity-comment-extendible', function(){

		var virtualthis = this;
		var current = jQuery(virtualthis).text();
		var currentElement = jQuery(virtualthis).clone();
		var parentId = jQuery(virtualthis).data('cid');
		var newc = "";
		var res = current.substring(0, 3);
		if (res=="[-]"){
			var children = (jQuery(virtualthis).closest("li").find("ul.children li"));
			console.log(children.length);
			var cs = jQuery.trim(jQuery(virtualthis).parent().find(".author-name").text().toString());
			var as = cs;
			var childrentext = children.length != 1 ? " nested comments" : " nested comment";
			newc = "[+] " + as + " ( "+ children.length + childrentext +" )";
			jQuery(currentElement).text(newc);
			var parent = jQuery(virtualthis).closest('li')
			console.log( parent )
			var index = jQuery(parent).prevAll().length;
			var parentUL = jQuery(parent).closest('ul');
			collapsedComments[parentId] = parent.detach();
			collapsedCommentPositions[parentId] = index;
			var li = jQuery(document.createElement("li"));
			var newEle = jQuery(currentElement);
			newEle.appendTo(li);
			if (index-1 < 0){
				index = 0;
				jQuery(parentUL).prepend(li);
			}else{
				index--;
				jQuery(jQuery(parentUL).children()).eq(index).after(li);
			}
		}else{
			newc = "";
			jQuery(virtualthis).text(newc);
			console.log("Expand tree");
			var parentUL = jQuery(virtualthis).closest("ul");
			var index = collapsedCommentPositions[parentId];
			var ele = collapsedComments[parentId];
			if (index-1 < 0){
				index = 0;
				jQuery(parentUL).prepend(ele);
			}else{
				index--;
				jQuery(jQuery(parentUL).children()).eq(index).after(ele);
			}
			jQuery(virtualthis).remove();
		}
	})

	window.combunitypluginmodaltoggleform = true;
	var combunity_mem = {};
	jQuery(".combunity-plugin-login-modal-show-email-form").on( "click", function(event){
		if ( window.combunitypluginmodaltoggleform ){
			window.combunity_modal_initialText = jQuery(".combunity-plugin-login-modal-show-email-form").text();
			jQuery(".combunity-plugin-login-modal-show-email-form").text(jQuery(".combunity-plugin-login-modal-show-email-form-back").text());
			jQuery(".combunity-plugin-login-modal-form-fields-container").slideDown("slow", function(){
			});	
			jQuery(".combunity-plugin-login-modal-social-login-container").hide();
		}else{
			
			jQuery(".combunity-plugin-login-modal-form-fields-container").slideUp("slow", function(){
				jQuery(".combunity-plugin-login-modal-show-email-form").text(window.combunity_modal_initialText);
				jQuery(".combunity-plugin-login-modal-social-login-container").show();
			});
		}
		window.combunitypluginmodaltoggleform = !window.combunitypluginmodaltoggleform;

		event.preventDefault();
	});

	var login = function(inData, cb){
		var data = {
			'action': 'combunity_auth_login',
			'data' : inData,
		}
		combunity.performAPIcall(ajaxurl, data , function (r){
			cb(r);
		});
	}

	var signup = function(inData, cb){

		var data = {
			'action': 'combunity_auth_signup',
			'data' : inData,
		}
		combunity.performAPIcall(ajaxurl, data , function (r){
			cb(r);

		});
	}

	jQuery(".combunity-login-form").on("submit", function(event){
		console.log("Submitting login form");

		event.preventDefault();
		if ( typeof ( window['combunityThemeLoginHandler'] ) == "function" ){
			window.combunity.login = login;
			window['combunityThemeLoginHandler']( event , this );
			return;
		}
		var submissionData = jQuery(this).serializeArray();
		var loginForm = this;
		jQuery(loginForm).find(".combunity-validation-msg").text("Logging in...");
		login(submissionData, function(r){
			if (r["error"]){
				var h = jQuery.parseHTML(r["info"]);
				jQuery(loginForm).find(".combunity-validation-msg").css("width", jQuery(loginForm).width());
				jQuery(loginForm).find(".combunity-validation-msg").html("");
				jQuery(h).appendTo(jQuery(loginForm).find(".combunity-validation-msg"));
			}else{
				location.reload();
			}
		})
		event.preventDefault();
	})

	jQuery(".combunity-signup-form").on("submit", function(event){
		var ctn = jQuery( "#combunity-signup-form" );
		var submissionData = jQuery(this).serializeArray();
		var loginForm = this;
		console.log(submissionData);
		jQuery(loginForm).find(".combunity-validation-msg").text("Signing up...");
		// jQuery(loginForm).find("input").attr("disabled");
		signup(submissionData, function(r){
			// console.log("Server returned!");
			// console.log(r);
			if (r["error"]){
				// combunity.hideloading( ctn )
				var h = jQuery.parseHTML(r["info"]);
				jQuery(".combunity-validation-msg").text("");
				jQuery(h).appendTo(jQuery(loginForm).find(".combunity-validation-msg"));
				// .text();
			}else{
				location.reload();
			}
		})
		event.preventDefault();
	})

})
