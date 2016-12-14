<?php
/**
 * Custom Post Type Recent Comments widget class
 *
 * @since 1.0.0
 * @package Custom Post Type Widgets
 */

class Combunity_Widget_Recent_Comments extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'widget_recent_replies', 'description' => __( 'Your forum\'s recent replies.', 'custom-post-type-widgets' ) );
		parent::__construct( 'custom-post-type-recent-comments', __( 'Combunity Recent Replies'), $widget_ops );
		$this->alt_option_name = 'combunity_cpost_recent_comments';

		if ( is_active_widget( false, false, $this->id_base ) ) {
			add_action( 'wp_head', array( $this, 'recent_comments_style' ) );
		}
	}

	public function recent_comments_style() {
		if ( ! current_theme_supports( 'widgets' ) // Temp hack #14876
			|| ! apply_filters( 'show_recent_comments_widget_style', true, $this->id_base ) ) {
			return;
		}
		?>
	<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;} .recentcomments{ margin-left:15px; }</style>
<?php
	}

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$output = '';

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Replies' ) : $instance['title'], $instance, $this->id_base );
		$posttype = ! empty( $instance['posttype']) ? $instance['posttype'] : '';
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
			$number = 5;
		}

		$comments = get_comments( apply_filters( 'widget_comments_args', array(
			'post_type' => 'cpost',
			'number' => $number,
			'status' => 'approve',
			'post_status' => 'publish',
		) ) );

		$output .= $args['before_widget'];
		if ( $title ) {
			$output .= $args['before_title'] . $title . $args['after_title'];
		}

		$output .= '<ul>';
		if ( $comments ) {
			// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
			$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
			_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

			foreach ( (array) $comments as $comment ) {
				$output .= '<div class="combunity-posts-stats-line">
								<div class="">
									<div class="">
										<span>';
				// $output .= '<li class="recentcomments">';
				/* translators: comments widget: 1: comment author, 2: post link */
				$output .= sprintf( _x( '%1$s on %2$s', 'widgets' ),
					'<span class="comment-author-link">' . Combunity_get_avatar( $comment ) . '</span>',
					'<a href="' . esc_url( get_comment_link( $comment ) ) . '">' . get_the_title( $comment->comment_post_ID ) . '</a>'
				);

				$output .= '			</span>
									</div>
								</div>
							</div>';
				// $output .= '</li>';
			}
		}
		$output .= '</ul>';
		$output .= $args['after_widget'];

		echo $output;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		// $instance['posttype'] = strip_tags( $new_instance['posttype'] );
		$instance['number'] = absint( $new_instance['number'] );
		return $instance;
	}

	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : '';
		$posttype = isset( $instance['posttype'] ) ? $instance['posttype']: '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'custom-post-type-widgets' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of comments to show:', 'custom-post-type-widgets' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}
