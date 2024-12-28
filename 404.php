<?php
/**
 * The 404 error page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package 3cb24
 */

get_header(); ?>
<div class="container">
	<div id="content" class="twelve columns clearfix">
		<h1>Not Found</h1>
		<p>Sorry, that page doesn't exist. Please try searching:</p>
		<div id="searchwrapper">
			<?php get_search_form(); ?> 
		</div>
	</div>
</div>
<?php get_footer(); ?>