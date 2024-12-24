<?php
/*
Template Name: Contact Page
*/
?>
<?php get_header(); ?>
<div class="container">
	<div id="content" class="six columns clearfix">
		<h1><?php the_title(); ?></h1>		
		<?php
			if ( have_posts() ) while ( have_posts() )
			{
				the_post();
				the_content();
			}
		?>	
	</div>	
	<div id="contactform" class="six columns">
		<?php echo do_shortcode('[contact-form-7 id="7" title="Contact form 1"]'); ?>
	</div>
</div>
<?php get_footer(); ?>