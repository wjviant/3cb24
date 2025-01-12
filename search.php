<?php get_header(); ?>
<div class="blogBanner banners">
<?php
	$page_for_posts = get_option( 'page_for_posts' );
	echo get_the_post_thumbnail( $page_for_posts, 'large' );
?>
	<div class="inner">
		<div class="container">
			<div class="twelve columns centre">
				<h1>Search Results</h1>
			</div>
		</div>
	</div>
</div> 

<div class="container">
	<div class="eight columns">
	<?php get_template_part('includes/postloop'); ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>