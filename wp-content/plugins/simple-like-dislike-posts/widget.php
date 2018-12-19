<?php
class sal_most_liked_posts_widget extends WP_Widget {
     
	public function __construct() {
		$widget_options = array( 
			'classname' => 'sal_most_liked_posts_widget',
			'description' => 'Widget to list most liked posts',
		);
		parent::__construct( 'sal_most_liked_posts_widget', 'Most Liked Posts', $widget_options );
	}
	
	public function widget( $args, $instance ) {
		global $wpdb;
		global $post;
		$table_name = $wpdb->prefix . "simpleLikeCounter";
		$postsCount = $instance['number_of_posts'];
		$title = $instance['title'];
		$result = $wpdb->get_results(" SELECT post_id,COUNT(*) as count FROM $table_name WHERE like_count='1' GROUP BY post_id ORDER BY count DESC LIMIT $postsCount");
		foreach($result as $res){
			$postIDs[] = $res->post_id;
		}

		$arguments = array(
			'post_type' => 'post',
			'post__in' => $postIDs,
			'orderby' => 'post__in'
		);
		$mlpQuery = new WP_Query($arguments);
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; 
		if($mlpQuery->have_posts()):
			?>
			<ul class="sal_most_liked">
			<?php 
			while($mlpQuery->have_posts() ): $mlpQuery->the_post();
			$post_id = get_the_ID();
			$likeCount = $wpdb->get_var(" SELECT COUNT(*) FROM $table_name WHERE post_id = '$post_id' AND like_count = '1' ");
			?>
			<li>
			<div class="sal_thumb_sect"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
			<div class="sal_title_sect">
				<p class="sal_post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
				<p class="sal_like_count"><?php echo $likeCount ?> Likes</p>
				<p class="sal_published_date">Posted on: <?php echo get_the_date(); ?></p>
			</div>
			</li>
			<?php
			endwhile;
			?>
			</ul>
			<?php
			wp_reset_postdata();
		endif;
		echo $args['after_widget'];
	}
	
	public function form( $instance ) {
		$postsCount = ! empty( $instance['number_of_posts'] ) ? $instance['number_of_posts'] : ''; 
		$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_of_posts' ); ?>">Number of posts:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'number_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_of_posts' ); ?>" value="<?php echo esc_attr( $postsCount ); ?>" />
		</p>
		<?php 
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'number_of_posts' ] = strip_tags( $new_instance[ 'number_of_posts' ] );
		return $instance;
	}
}
function sal_most_liked_posts() {
	register_widget( 'sal_most_liked_posts_widget' );
}
add_action( 'widgets_init', 'sal_most_liked_posts' );
?>