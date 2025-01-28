<?php
/**
 * Wiki category archive for 3cb24 theme
 *
 * @package tcb24
 */

get_header(); ?>
<div id="tcbWikiListing">
	<div class="blogBanner banners">
	<?php
		$page_for_posts = get_option( 'page_for_posts' );
		echo get_the_post_thumbnail( $page_for_posts, 'large' );
	?>
		<div class="inner">
			<div class="container">
				<div class="twelve columns centre">
					<h1>Information Centre</h1>
					<div id="wikiSearch"><?php get_search_form(); ?></div>
				</div>
			</div>
		</div>
	</div> 
	<div id="tcbWikiContent" class="container">
		<div class="tcbWikiArticles padded white">
			<div class="bread has-small-font-size">
				<?php if( function_exists( "seopress_display_breadcrumbs" ) ) {
					seopress_display_breadcrumbs();
				} ?>
			</div>
			<h2><?php single_cat_title(); ?></h2>
		<?php
		if ( have_posts() ) { ?>
			<ul class="wikiDocs">
			<?php while ( have_posts() ) {
				the_post();
				?>
				<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></li>
				<?php
			}
			
			?></ul>
			<div class="navigation">
				<div class="navlink"><?php next_posts_link(); ?></div>
				<div class="navlink"><?php previous_posts_link(); ?></div>
			</div>
		</div>
			<?php
		} else {
			?>
			<h2 class="center">Not Found</h2>  
			<p class="center">Sorry, but you are looking for something that isn't here.</p>
			<?php
			get_search_form();
		}
		?>
	</div>
</div>
<?php get_footer(); ?>