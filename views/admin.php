<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Plugin_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2013 Your Name or Company Name
 */
?>
<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	<?php
		$args = array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'orderby' => 'post_date',
			'order' => 'DESC'
		);
		$pages = new WP_Query( $args );

		$five_year_heading = null;
		$four_year_heading = null;
		$three_year_heading = null;
		$two_year_heading = null;
		$one_year_heading = null;
		$six_month_heading = null;
		$five_year_posts = null;
		$four_year_posts = null;
		$three_year_posts = null;
		$two_year_posts = null;
		$one_year_posts = null;
		$six_month_posts = null;
		$winning = null;

		$wrap_open = '<div class="reaction-wrap">';
		$wrap_close = '</div>';
		$table_open = '<table class="widefat">';
		$table_head = '<thead><tr><th>' . __( 'Post ID', 'update-shaming' ) . '</th><th>' . __( 'Page Title', 'update-shaming' ) . '</th><th>' . __( 'Last Modified', 'update-shaming' ) . '</th><th>' . __( 'FIX IT!!', 'update-shaming' ) . '</th></tr></thead><tbody>';
		$table_close = '</tbody></table>';

		//var_dump( $pages );
		$i = 0;
		// the loop
		if ( $pages->have_posts() ) : while ( $pages->have_posts() ) : $pages->the_post();
			$post_date = date( 'Ymd', strtotime(get_the_modified_date()) );
			$i++;
			// posts more than five years old
			if ( $this->five_years_check($post_date) ) :
				$five_year_heading = '<h2>' . __( 'These pages haven\'t been updated in more than five years!', 'update-shaming' ) . '</h2>';
				$five_year_posts .= '<tr>';
				$five_year_posts .= '<td>' . get_the_ID() . '</td>';
				$five_year_posts .= '<td><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong></td>';
				$five_year_posts .= '<td>' . get_the_modified_date() . '</td>';
				$five_year_posts .= '<td><a href="post.php?post='.get_the_ID().'&action=edit"><span class="trash">Edit</span></a></td>';
			endif; // end five or more years

			// posts more than four years old
			if ( $this->four_years_check($post_date) ) :
				$four_year_heading = '<h2>' . __( 'These pages haven\'t been updated in more than four years!', 'update-shaming' ) . '</h2>';
				$four_year_posts .= '<tr>';
				$four_year_posts .= '<td>' . get_the_ID() . '</td>';
				$four_year_posts .= '<td><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong></td>';
				$four_year_posts .= '<td>' . get_the_modified_date() . '</td>';
				$four_year_posts .= '<td><a href="post.php?post='.get_the_ID().'&action=edit"><span class="trash">Edit</span></a></td>';
			endif;// end four to five years

			// posts more than three years old
			if ( $this->three_years_check($post_date) ) :
				$three_year_heading = '<h2>' . __( 'These pages haven\'t been updated in more than three years!', 'update-shaming' ) . '</h2>';
				$three_year_posts .= '<tr>';
				$three_year_posts .= '<td>' . get_the_ID() . '</td>';
				$three_year_posts .= '<td><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong></td>';
				$three_year_posts .= '<td>' . get_the_modified_date() . '</td>';
				$three_year_posts .= '<td><a href="post.php?post='.get_the_ID().'&action=edit"><span class="trash">Edit</span></a></td>';
			endif;// end three to four years

			// posts more than two years old
			if ( $this->two_years_check($post_date) ) :
				$two_year_heading = '<h2>' . __( 'These pages haven\'t been updated in more than two years!', 'update-shaming' ) . '</h2>';
				$two_year_posts .= '<tr>';
				$two_year_posts .= '<td>' . get_the_ID() . '</td>';
				$two_year_posts .= '<td><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong></td>';
				$two_year_posts .= '<td>' . get_the_modified_date() . '</td>';
				$two_year_posts .= '<td><a href="post.php?post='.get_the_ID().'&action=edit"><span class="trash">Edit</span></a></td>';
			endif;// end two to three years

			// posts more than one year old
			if ( $this->one_year_check($post_date) ) :
				$one_year_heading = '<h2>' . __( 'These pages haven\'t been updated in more than a year.', 'update-shaming' ) . '</h2>';
				$one_year_posts .= '<tr>';
				$one_year_posts .= '<td>' . get_the_ID() . '</td>';
				$one_year_posts .= '<td><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong></td>';
				$one_year_posts .= '<td>' . get_the_modified_date() . '</td>';
				$one_year_posts .= '<td><a href="post.php?post='.get_the_ID().'&action=edit"><span class="trash">Edit</span></a></td>';
			endif;// end one to two years

			// posts more than six months old
			if ( $this->six_months_check($post_date) ) :
				$six_month_heading = '<h2>' . __( 'These pages haven\'t been updated in the last six months.', 'update-shaming' ) . '</h2>';
				$six_month_posts .= '<tr>';
				$six_month_posts .= '<td>' . get_the_ID() . '</td>';
				$six_month_posts .= '<td><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong></td>';
				$six_month_posts .= '<td>' . get_the_modified_date() . '</td>';
				$six_month_posts .= '<td><a href="post.php?post='.get_the_ID().'&action=edit"><span class="trash">Edit</span></a></td>';
			endif;// end one to two years

			// posts are more recent than six months
			if ( $this->up_to_date_check($post_date) ) :
				$winning = '<h2>' . __( 'You\'re winning the internet. All your pages are (more or less) up-to-date.', 'update-shaming' ) . '</h2>';
			endif;// end updated posts

		endwhile; else :
			echo '<h3>Holy fuck! I couldn\'t find any pages! What the hell is wrong with you?</h3>';
		endif;


		if ( $five_year_heading ) {
			echo $wrap_open;
			echo '<img src="'. plugins_url( 'reactions/five-years/' . rand(0,10) . '.gif', dirname(__FILE__) ) . '" class="reactiongif" />';
			echo $five_year_heading;
			echo $wrap_close;
			echo $table_open;
			echo $table_head;
			echo $five_year_posts;
			echo $table_close;
		}
		if ( $four_year_heading ) {
			echo $wrap_open;
			echo '<img src="'. plugins_url( 'reactions/four-years/' . rand(0,9) . '.gif', dirname(__FILE__) ) . '" class="reactiongif" />';
			echo $four_year_heading;
			echo $wrap_close;
			echo $table_open;
			echo $table_head;
			echo $four_year_posts;
			echo $table_close;
		}
		if ( $three_year_heading ) {
			echo $wrap_open;
			echo '<img src="'. plugins_url( 'reactions/three-years/' . rand(0,9) . '.gif', dirname(__FILE__) ) . '" class="reactiongif" />';
			echo $three_year_heading;
			echo $wrap_close;
			echo $table_open;
			echo $table_head;
			echo $three_year_posts;
			echo $table_close;
		}
		if ( $two_year_heading ) {
			echo $wrap_open;
			echo '<img src="'. plugins_url( 'reactions/two-years/' . rand(0,9) . '.gif', dirname(__FILE__) ) . '" class="reactiongif" />';
			echo $two_year_heading;
			echo $wrap_close;
			echo $table_open;
			echo $table_head;
			echo $two_year_posts;
			echo $table_close;
		}
		if ( $one_year_heading ) {
			echo $wrap_open;
			echo '<img src="'. plugins_url( 'reactions/one-year/' . rand(0,9) . '.gif', dirname(__FILE__) ) . '" class="reactiongif" />';
			echo $one_year_heading;
			echo $wrap_close;
			echo $table_open;
			echo $table_head;
			echo $one_year_posts;
			echo $table_close;
		}
		if ( $six_month_heading ) {
			echo $wrap_open;
			echo '<img src="'. plugins_url( 'reactions/six-months/' . rand(0,9) . '.gif', dirname(__FILE__) ) . '" class="reactiongif" />';
			echo $six_month_heading;
			echo $wrap_close;
			echo $table_open;
			echo $table_head;
			echo $six_month_posts;
			echo $table_close;
		}
		if ( $winning ) {
			echo $wrap_open;
			echo '<img src="'. plugins_url( 'reactions/winning/' . rand(0,5) . '.gif', dirname(__FILE__) ) . '" class="reactiongif" />';
			echo $winning;
			echo $wrap_close;
		}
	?>
</div>
