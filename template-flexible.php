<?php
/*
Template Name: Flexible content Page
*/
?>
<?php get_header(); ?>

	
	<div id="content" class="clear">
		<div class="container">
			<div class="twelve columns clearfix flexible">
			<?php 
				if ( have_posts() ) while ( have_posts() )
				{
					the_post();
					the_content();
				}?>
			</div>	
		</div>
	</div>
	
	
	<div class="wrap clear">
	<?php get_template_part('includes/flexible-content'); ?>
	</div>
<?php get_footer(); ?>