<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Update_Shaming
 * @author    Chris Reynolds <hello@chrisreynolds.io>
 * @license   GPL-3.0
 * @link      http://chrisreynolds.io
 * @copyright 2013 Chris Reynolds
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

		// initialize these variables
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

		// this will be used later to build the tables
		$wrap_open = '<div class="reaction-wrap">'; // opens the admin page content
		$wrap_close = '</div>'; // closes it
		$table_open = '<table class="widefat ood">'; // open the table
		$table_head = '<thead><tr><th class="id">' . __( 'Post ID', 'update-shaming' ) . '</th><th class="title">' . __( 'Page Title', 'update-shaming' ) . '</th><th class="modified">' . __( 'Last Modified', 'update-shaming' ) . '</th><th class="fixit">' . __( 'FIX IT!!', 'update-shaming' ) . '</th></tr></thead><tbody>'; // sets the table headings
		$table_close = '</tbody></table>'; // closes the table

		// fetch the reactions
		$reactions = $this->reactions();

		// the loop
		if ( $pages->have_posts() ) : while ( $pages->have_posts() ) : $pages->the_post();
			$post_date = date( 'Ymd', strtotime(get_the_modified_date()) );
			// posts more than five years old
			if ( $this->five_years_check($post_date) ) :
				$five_year_reaction = $reactions['five-years'][rand(0,4)]; // get the reactions
				$five_year_heading = '<h2>' . __( 'These pages haven\'t been updated in more than five years!', 'update-shaming' ) . '</h2>';
				$five_year_posts .= '<tr>';
				$five_year_posts .= '<td class="id">' . get_the_ID() . '</td>';
				$five_year_posts .= '<td class="title"><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong><br /><a href="'.get_permalink().'" target="_blank">' . __('View Page', 'update-shaming') .'</a></td>';
				$five_year_posts .= '<td class="modified">' . get_the_modified_date() . '</td>';
				$five_year_posts .= '<td class="fixit"><span class="trash"><a href="post.php?post='.get_the_ID().'&action=edit">Edit</a></span></td>';
			endif; // end five or more years

			// posts more than four years old
			if ( $this->four_years_check($post_date) ) :
				$four_year_reaction = $reactions['four-years'][rand(0,4)]; // get the reactions
				$four_year_heading = '<h2>' . __( 'These pages haven\'t been updated in more than four years!', 'update-shaming' ) . '</h2>';
				$four_year_posts .= '<tr>';
				$four_year_posts .= '<td class="id">' . get_the_ID() . '</td>';
				$four_year_posts .= '<td class="title"><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong><br /><a href="'.get_permalink().'" target="_blank">' . __('View Page', 'update-shaming') .'</a></td>';
				$four_year_posts .= '<td class="modified">' . get_the_modified_date() . '</td>';
				$four_year_posts .= '<td class="fixit"><span class="trash"><a href="post.php?post='.get_the_ID().'&action=edit">Edit</a></span></td>';
			endif;// end four to five years

			// posts more than three years old
			if ( $this->three_years_check($post_date) ) :
				$three_year_reaction = $reactions['three-years'][rand(0,4)]; // get the reactions
				$three_year_heading = '<h2>' . __( 'These pages haven\'t been updated in more than three years!', 'update-shaming' ) . '</h2>';
				$three_year_posts .= '<tr>';
				$three_year_posts .= '<td class="id">' . get_the_ID() . '</td>';
				$three_year_posts .= '<td class="title"><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong><br /><a href="'.get_permalink().'" target="_blank">' . __('View Page', 'update-shaming') .'</a></td>';
				$three_year_posts .= '<td class="modified">' . get_the_modified_date() . '</td>';
				$three_year_posts .= '<td class="fixit"><span class="trash"<a href="post.php?post='.get_the_ID().'&action=edit">>></aEdit</span></td>';
			endif;// end three to four years

			// posts more than two years old
			if ( $this->two_years_check($post_date) ) :
				$two_year_reaction = $reactions['two-years'][rand(0,4)]; // get the reactions
				$two_year_heading = '<h2>' . __( 'These pages haven\'t been updated in more than two years!', 'update-shaming' ) . '</h2>';
				$two_year_posts .= '<tr>';
				$two_year_posts .= '<td class="id">' . get_the_ID() . '</td>';
				$two_year_posts .= '<td class="title"><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong><br /><a href="'.get_permalink().'" target="_blank">' . __('View Page', 'update-shaming') .'</a></td>';
				$two_year_posts .= '<td class="modified">' . get_the_modified_date() . '</td>';
				$two_year_posts .= '<td class="fixit"><span class="tt"><a href="post.php?post='.get_the_ID().'&action=edirash">Edit</a></span></td>';
			endif;// end two to three years

			// posts more than one year old
			if ( $this->one_year_check($post_date) ) :
				$one_year_reaction = $reactions['one-year'][rand(0,4)]; // get the reactions
				$one_year_heading = '<h2>' . __( 'These pages haven\'t been updated in more than a year.', 'update-shaming' ) . '</h2>';
				$one_year_posts .= '<tr>';
				$one_year_posts .= '<td class="id">' . get_the_ID() . '</td>';
				$one_year_posts .= '<td class="title"><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong><br /><a href="'.get_permalink().'" target="_blank">' . __('View Page', 'update-shaming') .'</a></td>';
				$one_year_posts .= '<td class="modified">' . get_the_modified_date() . '</td>';
				$one_year_posts .= '<td class="fixit"><span class="tt"><a href="post.php?post='.get_the_ID().'&action=edirash">Edit</a></span></td>';
			endif;// end one to two years

			// posts more than six months old
			if ( $this->six_months_check($post_date) ) :
				$six_month_reaction = $reactions['six-months'][rand(0,4)]; // get the reactions
				$six_month_heading = '<h2>' . __( 'These pages haven\'t been updated in the last six months.', 'update-shaming' ) . '</h2>';
				$six_month_posts .= '<tr>';
				$six_month_posts .= '<td class="id">' . get_the_ID() . '</td>';
				$six_month_posts .= '<td class="title"><strong><a href="post.php?post='.get_the_ID().'&action=edit">' . get_the_title() . '</a></strong><br /><a href="'.get_permalink().'" target="_blank">' . __('View Page', 'update-shaming') .'</a></td>';
				$six_month_posts .= '<td class="modified">' . get_the_modified_date() . '</td>';
				$six_month_posts .= '<td class="fixit"><span class="trash"><a href="post.php?post='.get_the_ID().'&action=edit">Edit</a></span></td>';
			endif;// end one to two years

			// posts are more recent than six months
			if ( $this->up_to_date_check($post_date) ) :
				$winning_reaction = $reactions['winning'][rand(0,4)]; // get the reactions
				$winning = '<h2>' . __( 'You\'re winning the internet. All your pages are (more or less) up-to-date.', 'update-shaming' ) . '</h2>';
			endif;// end updated posts

		endwhile; else :
			echo '<h2>'. __( 'I couldn\'t find any pages. None at all.', 'update-shaming' ) .'</h2>';
		endif;

		// if a heading for five years has been set, we've got five+ year old pages
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
		// if a heading for four years has been set, we've got four+ year old pages
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
		// if a heading for three years has been set, we've got three+ year old pages
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
		// if a heading for two years has been set, we've got two+ year old pages
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
		// if a heading for one year has been set, we've got one+ year old pages
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
		// if a heading for six months has been set, we've got six+ month old pages
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
		// if there are no headings and the winning check returns true, have a drink
		if ( !$five_year_heading && !$four_year_heading && !$three_year_heading && !$two_year_heading && !$one_year_heading && !$six_month_heading && $winning ) {
			echo $wrap_open;
			echo '<dl class="wp-caption"><dt class="wp-caption-dt"><img src="'. $winning_reaction['url'] . '" class="reactiongif" /></dt><dd class="wp-caption-dd">' . __( 'Source:', 'update-shaming' ) . ' ' . $winning_reaction['source'] . '</dd></dl>';
			echo $winning;
			echo $wrap_close;
		}
	?>
</div>
