<?php
/**
 * Template Name: Wiki page
 *
 * @package 3cb24
 */

get_header(); ?>
	<div id="content">
		<div class="container">
			<div class="twelve columns">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					the_content();
				}
			}
			?>
			</div>
		</div>
	</div>	
<?php get_footer(); ?>