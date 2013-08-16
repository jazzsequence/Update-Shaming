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
		$table_open = '<table class="widefat ood">';
		$table_head = '<thead><tr><th class="id">' . __( 'Post ID', 'update-shaming' ) . '</th><th class="title">' . __( 'Page Title', 'update-shaming' ) . '</th><th class="modified">' . __( 'Last Modified', 'update-shaming' ) . '</th><th class="fixit">' . __( 'FIX IT!!', 'update-shaming' ) . '</th></tr></thead><tbody>';
		$table_close = '</tbody></table>';

		$reactions = $this->reactions();

		//var_dump( $pages );
		$i = 0;
		// the loop
		if ( $pages->have_posts() ) : while ( $pages->have_posts() ) : $pages->the_post();
			$post_date = date( 'Ymd', strtotime(get_the_modified_date()) );
			$i++;
			// posts more than five years old
			if ( $this->five_years_check($post_date) ) :
				$five_year_reaction = $reactions['five-years'][rand(0,4)];
				$five_year_heading = '<h2>' . __( 'These pages haven\'t been updated in more than five years!', 'update-shaming' ) . '</h2>';
				$five_year_posts .= '<tr>';
				$five_year_posts .= '<td class="id">' . get_the_ID() . '</td>';
				$five_year_posts .= '<td class="title"><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong></td>';
				$five_year_posts .= '<td class="modified">' . get_the_modified_date() . '</td>';
				$five_year_posts .= '<td class="fixit"><a href="post.php?post='.get_the_ID().'&action=edit"><span class="trash">Edit</span></a></td>';
			endif; // end five or more years

			// posts more than four years old
			if ( $this->four_years_check($post_date) ) :
				$four_year_reaction = $reactions['four-years'][rand(0,4)];
				$four_year_heading = '<h2>' . __( 'These pages haven\'t been updated in more than four years!', 'update-shaming' ) . '</h2>';
				$four_year_posts .= '<tr>';
				$four_year_posts .= '<td class="id">' . get_the_ID() . '</td>';
				$four_year_posts .= '<td class="title"><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong></td>';
				$four_year_posts .= '<td class="modified">' . get_the_modified_date() . '</td>';
				$four_year_posts .= '<td class="fixit"><a href="post.php?post='.get_the_ID().'&action=edit"><span class="trash">Edit</span></a></td>';
			endif;// end four to five years

			// posts more than three years old
			if ( $this->three_years_check($post_date) ) :
				$three_year_reaction = $reactions['three-years'][rand(0,4)];
				$three_year_heading = '<h2>' . __( 'These pages haven\'t been updated in more than three years!', 'update-shaming' ) . '</h2>';
				$three_year_posts .= '<tr>';
				$three_year_posts .= '<td class="id">' . get_the_ID() . '</td>';
				$three_year_posts .= '<td class="title"><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong></td>';
				$three_year_posts .= '<td class="modified">' . get_the_modified_date() . '</td>';
				$three_year_posts .= '<td class="fixit"><a href="post.php?post='.get_the_ID().'&action=edit"><span class="trash">Edit</span></a></td>';
			endif;// end three to four years

			// posts more than two years old
			if ( $this->two_years_check($post_date) ) :
				$two_year_reaction = $reactions['two-years'][rand(0,4)];
				$two_year_heading = '<h2>' . __( 'These pages haven\'t been updated in more than two years!', 'update-shaming' ) . '</h2>';
				$two_year_posts .= '<tr>';
				$two_year_posts .= '<td class="id">' . get_the_ID() . '</td>';
				$two_year_posts .= '<td class="title"><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong></td>';
				$two_year_posts .= '<td class="modified">' . get_the_modified_date() . '</td>';
				$two_year_posts .= '<td class="fixit"><a href="post.php?post='.get_the_ID().'&action=edit"><span class="trash">Edit</span></a></td>';
			endif;// end two to three years

			// posts more than one year old
			if ( $this->one_year_check($post_date) ) :
				$one_year_reaction = $reactions['one-year'][rand(0,4)];
				$one_year_heading = '<h2>' . __( 'These pages haven\'t been updated in more than a year.', 'update-shaming' ) . '</h2>';
				$one_year_posts .= '<tr>';
				$one_year_posts .= '<td class="id">' . get_the_ID() . '</td>';
				$one_year_posts .= '<td class="title"><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong></td>';
				$one_year_posts .= '<td class="modified">' . get_the_modified_date() . '</td>';
				$one_year_posts .= '<td class="fixit"><a href="post.php?post='.get_the_ID().'&action=edit"><span class="trash">Edit</span></a></td>';
			endif;// end one to two years

			// posts more than six months old
			if ( $this->six_months_check($post_date) ) :
				$six_month_reaction = $reactions['six-months'][rand(0,4)];
				$six_month_heading = '<h2>' . __( 'These pages haven\'t been updated in the last six months.', 'update-shaming' ) . '</h2>';
				$six_month_posts .= '<tr>';
				$six_month_posts .= '<td class="id">' . get_the_ID() . '</td>';
				$six_month_posts .= '<td class="title"><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong></td>';
				$six_month_posts .= '<td class="modified">' . get_the_modified_date() . '</td>';
				$six_month_posts .= '<td class="fixit"><a href="post.php?post='.get_the_ID().'&action=edit"><span class="trash">Edit</span></a></td>';
			endif;// end one to two years

			// posts are more recent than six months
			if ( $this->up_to_date_check($post_date) ) :
				$winning_reaction = $reactions['winning'][rand(0,4)];
				$winning = '<h2>' . __( 'You\'re winning the internet. All your pages are (more or less) up-to-date.', 'update-shaming' ) . '</h2>';
			endif;// end updated posts

		endwhile; else :
			echo '<h3>Holy fuck! I couldn\'t find any pages! What the hell is wrong with you?</h3>';
		endif;

		if ( $five_year_heading ) {
			echo $wrap_open;
			echo $five_year_heading;
			echo '<dl class="wp-caption"><dt class="wp-caption-dt"><img src="'. $five_year_reaction['url'] . '" class="reactiongif" /></dt><dd class="wp-caption-dd"><span class="caption">' . $five_year_reaction['caption'] . '</span><br />' . __( 'Source:', 'update-shaming' ) . ' ' . $five_year_reaction['source'] . '</dd></dl>';
			echo $wrap_close;
			echo $table_open;
			echo $table_head;
			echo $five_year_posts;
			echo $table_close;
		}
		if ( $four_year_heading ) {
			echo $wrap_open;
			echo $four_year_heading;
			echo '<dl class="wp-caption"><dt class="wp-caption-dt"><img src="'. $four_year_reaction['url'] . '" class="reactiongif" /></dt><dd class="wp-caption-dd"><span class="caption">' . $four_year_reaction['caption'] . '</span><br />' . __( 'Source:', 'update-shaming' ) . ' ' . $four_year_reaction['source'] . '</dd></dl>';
			echo $wrap_close;
			echo $table_open;
			echo $table_head;
			echo $four_year_posts;
			echo $table_close;
		}
		if ( $three_year_heading ) {
			echo $wrap_open;
			echo $three_year_heading;
			echo '<dl class="wp-caption"><dt class="wp-caption-dt"><img src="'. $three_year_reaction['url'] . '" class="reactiongif" /></dt><dd class="wp-caption-dd"><span class="caption">' . $three_year_reaction['caption'] . '</span><br />' . __( 'Source:', 'update-shaming' ) . ' ' . $three_year_reaction['source'] . '</dd></dl>';
			echo $wrap_close;
			echo $table_open;
			echo $table_head;
			echo $three_year_posts;
			echo $table_close;
		}
		if ( $two_year_heading ) {
			echo $wrap_open;
			echo $two_year_heading;
			echo '<dl class="wp-caption"><dt class="wp-caption-dt"><img src="'. $two_year_reaction['url'] . '" class="reactiongif" /></dt><dd class="wp-caption-dd"><span class="caption">' . $two_year_reaction['caption'] . '</span><br />' . __( 'Source:', 'update-shaming' ) . ' ' . $two_year_reaction['source'] . '</dd></dl>';
			echo $wrap_close;
			echo $table_open;
			echo $table_head;
			echo $two_year_posts;
			echo $table_close;
		}
		if ( $one_year_heading ) {
			echo $wrap_open;
			echo $one_year_heading;
			echo '<dl class="wp-caption"><dt class="wp-caption-dt"><img src="'. $one_year_reaction['url'] . '" class="reactiongif" /></dt><dd class="wp-caption-dd"><span class="caption">' . $one_year_reaction['caption'] . '</span><br />' . __( 'Source:', 'update-shaming' ) . ' ' . $one_year_reaction['source'] . '</dd></dl>';
			echo $wrap_close;
			echo $table_open;
			echo $table_head;
			echo $one_year_posts;
			echo $table_close;
		}
		if ( $six_month_heading ) {
			echo $wrap_open;
			echo $six_month_heading;
			echo '<dl class="wp-caption"><dt class="wp-caption-dt"><img src="'. $six_month_reaction['url'] . '" class="reactiongif" /></dt><dd class="wp-caption-dd"><span class="caption">' . $six_month_reaction['caption'] . '</span><br />' . __( 'Source:', 'update-shaming' ) . ' ' . $six_month_reaction['source'] . '</dd></dl>';
			echo $wrap_close;
			echo $table_open;
			echo $table_head;
			echo $six_month_posts;
			echo $table_close;
		}
		if ( !$five_year_heading && !$four_year_heading && !$three_year_heading && !$two_year_heading && !$one_year_heading && !$six_month_heading && $winning ) {
			echo $wrap_open;
			echo '<dl class="wp-caption"><dt class="wp-caption-dt"><img src="'. $winning_reaction['url'] . '" class="reactiongif" /></dt><dd class="wp-caption-dd"><span class="caption">' . $winning_reaction['caption'] . '</span><br />' . __( 'Source:', 'update-shaming' ) . ' ' . $winning_reaction['source'] . '</dd></dl>';
			echo $winning;
			echo $wrap_close;
		}
	?>
</div>
