<?php
/**
 * The 404 error page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package 3cb24
 */

get_header(); ?>
<div class="blogBanner banners">
<?php
	$page_for_posts = get_option( 'page_for_posts' );
	echo get_the_post_thumbnail( $page_for_posts, 'large' );
?>
	<div class="inner">
		<div class="container">
			<div class="twelve columns centre">
				<h1>Not Found</h1>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div id="content" class="eight columns">
		<p>Sorry, that page doesn't exist. Please try searching:</p>
		<div id="searchwrapper">
			<?php get_search_form(); ?>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>