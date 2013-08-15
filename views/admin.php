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

	<p><?php _e( 'This page displays a list of pages that have not been updated recently.', 'update-shaming' ); ?></p>

	<?php

		$today = date('Y-m-d');
		$one_year_ago = date( 'Ymd', strtotime( $today . ' -1 year' ) );
		$two_years_ago = date( 'Ymd', strtotime( $today . ' -2 years' ) );
		$three_years_ago = date( 'Ymd', strtotime( $today . ' -3 years' ) );
		$four_years_ago = date( 'Ymd', strtotime( $today . ' -4 years' ) );
		$five_years_ago = date( 'Ymd', strtotime( $today . ' -5 years' ) );
		$six_months_ago = date( 'Ymd', strtotime( $today . ' -6 months' ) );

		$args = array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'orderby' => 'post_date',
			'order' => 'DESC'
		);
		$pages = new WP_Query( $args );

		$date_format = get_option('date_format');


		echo '<p><strong>This is today:</strong> ' . $today . '</p>';
		echo '<p><strong>This is a year ago:</strong> ' . $a_year_ago . '</p>';

		//var_dump( $pages );
		$i = 0;
		// the loop
		if ( $pages->have_posts() ) : while ( $pages->have_posts() ) : $pages->the_post();
			$post_date = date( 'Ymd', strtotime(get_the_modified_date()) );
			$i++;
			// posts more than five years old
			if ( $this->five_years_check($post_date) ) :
				$five_year_heading = '<h3>Holy fuck, these pages are more than five years old!</h3>';
				$five_year_posts .= '<p>'.get_the_title().'<br />';
				$five_year_posts .= 'Last updated: ' . get_the_modified_date() . '</p>';
				$five_year_posts .= 'debug: $post_date = ' . $post_date . ' <= $five_years_ago = ' . $five_years_ago . '<br />$i = ' . $i;
			endif; // end five or more years

			// posts more than four years old
			if ( $this->four_years_check($post_date) ) :
				$four_year_heading = '<h3>Holy fuck, these pages are more than four years old!</h3>';
				$four_year_posts .= '<p>'.get_the_title().'<br />';
				$four_year_posts .= 'Last updated: ' . get_the_modified_date() . '</p>';
				$four_year_posts .= 'debug: $post_date = ' . $post_date . ' <= $four_years_ago = ' . $four_years_ago . '<br />$i = ' . $i;
			endif;// end four to five years

			// posts more than three years old
			if ( $this->three_years_check($post_date) ) :
				$three_year_heading = '<h3>Holy fuck, these pages are more than three years old!</h3>';
				$three_year_posts .= '<p>'.get_the_title().'<br />';
				$three_year_posts .= 'Last updated: ' . get_the_modified_date() . '</p>';
				$three_year_posts .= 'debug: $post_date = ' . $post_date . ' <= $three_years_ago = ' . $three_years_ago . '<br />$i = ' . $i;
			endif;// end three to four years

			// posts more than two years old
			if ( $this->two_years_check($post_date) ) :
				$two_year_heading = '<h3>Holy fuck, these pages are more than two years old!</h3>';
				$two_year_posts .= '<p>'.get_the_title().'<br />';
				$two_year_posts .= 'Last updated: ' . get_the_modified_date() . '</p>';
				$two_year_posts .= 'debug: $post_date = ' . $post_date . ' <= $two_years_ago = ' . $two_years_ago . '<br />$i = ' . $i;
			endif;// end two to three years

			// posts more than one year old
			if ( $this->one_year_check($post_date) ) :
				$one_year_heading = '<h3>Holy fuck, these pages are more than one year old!</h3>';
				$one_year_posts .= '<p>'.get_the_title().'<br />';
				$one_year_posts .= 'Last updated: ' . get_the_modified_date() . '</p>';
				$one_year_posts .= 'debug: $post_date = ' . $post_date . ' <= $one_year_ago = ' . $one_year_ago . '<br />$i = ' . $i;
			endif;// end one to two years

			// posts more than six months old
			if ( $this->six_months_check($post_date) ) :
				$six_month_heading = '<h3>Holy fuck, these pages are more than six months old!</h3>';
				$six_month_posts .= '<p>'.get_the_title().'<br />';
				$six_month_posts .= 'Last updated: ' . get_the_modified_date() . '</p>';
				$six_month_posts .= 'debug: $post_date = ' . $post_date . ' <= $six_months_ago = ' . $six_months_ago . '<br />$i = ' . $i;
			endif;// end one to two years

		endwhile; endif;


		if ( $five_year_heading ) {
			echo $five_year_heading;
			echo $five_year_posts;
		}
		if ( $four_year_heading ) {
			echo $four_year_heading;
			echo $four_year_posts;
		}
		if ( $three_year_heading ) {
			echo $three_year_heading;
			echo $three_year_posts;
		}
		if ( $two_year_heading ) {
			echo $two_year_heading;
			echo $two_year_posts;
		}
		if ( $one_year_heading ) {
			echo $one_year_heading;
			echo $one_year_posts;
		}
		if ( $six_months_heading ) {
			echo $six_months_heading;
			echo $six_months_posts;
		}

	?>

</div>
