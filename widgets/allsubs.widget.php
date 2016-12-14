<?php 
class Combunity_AllSubs extends WP_Widget {
	protected $default_title = "All Forums";
	protected $description = "All Forums";
	protected $type = "24h";
	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'combunity_allsubs_widget',
			'description' => "Display's all of Combunity's Subs",
		);
		parent::__construct( 'combunity_allsubs', 'Combunity List of Forums', $widget_ops );
	}

	public function is_selected( $name ,$val ){
    	if ( $name == $val ){
    		print "selected";
    	}
    }

    public function small( $content ){
    	// $limit = 22;
    	$limit = 50;
    	if ( strlen($content) > $limit ):
	    	// $pos=strpos($content, ' ', $limit );
			$new_str = substr($content,0,$limit ) . "..."; 
			return $new_str;
		endif;
		return $content;
		
    }

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( $this->default_title, 'combunity' );
		$description = ! empty( $instance['description'] ) ? $instance['description'] : $this->description;

		$forums =  get_terms( array(
		    'taxonomy' => 'cforum',
		    'hide_empty' => false,
		) );
	

		?>
		<li class="combunity-widget-stats combunity-widget-stats-user combunity-widget">
			<div class="combunity-widget-title"><?php echo $title ?></div>
			<p><?php echo $description; ?></p>
			<div class="combunity-widget-content">
			<?php
			foreach ($forums as $row) {
				
				$color = '#' . Combunity_Api()->get_forum_meta( $row , 'custom_color', 'FFFFFF' );
				
				?>
					<div class="combunity-posts-stats-line">
						<div class="combunity-row">
							<div class="">
								<span class="combunity-widget-sub-color" style="background-color:<?php echo $color ?>">
									
								</span>
								<span>
									<a href="<?php echo get_term_link( $row ) ?>"><?php echo $row->name ?></a>
								</span>
								
							</div>
						</div>
					</div>
				
				<?php
			}
			if ( sizeof( $forums ) == 0 ){
				if (current_user_can("manage_options")){
					echo "<div style='color:red !important; font-style:italic;'>";
					echo __("You need to create some forums first.", "combunity");
					echo '</div>';
				}
			}
			?>
			</div>
		</li>
		<?php
	}
    

    
    


	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( $this->default_title, 'combunity' );
		$description = ! empty( $instance['description'] ) ? $instance['description'] : $this->description;
		$type = ! empty( $instance['type'] ) ? $instance['type'] : $this->type ;
		?>
		<p>
			<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_name( 'description' ); ?>"><?php _e( 'Description:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_name( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
		</p>
		<?php 
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['type'] = ( ! empty( $new_instance['type'] ) ) ? strip_tags( $new_instance['type'] ) : $this->type ;
		return $instance;
	}
}