<?php get_header(); ?>
<div class="container">
	<div id="content" class="twelve columns clearfix">
	
	<h1>Search Results</h1>
	
	<?php if ( have_posts() ) : ?>               
 
	<?php while ( have_posts() ) : the_post() ?>
		 	
		<?php if ( has_post_thumbnail()) : ?>
			<div class="newsthumb">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
					<img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>"> 
				</a>
			</div> 
			<?php endif; ?>
					
	
		 	
	 	<h3 class="blog-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3> 
		                
		<?php the_excerpt('Read the rest of this entry »'); ?>  
				
		<?php endwhile; ?>
			
		<div class="navigation">  
			<div class="alignleft"><?php next_posts_link('« Previous Entries') ?></div>  
			<div class="alignright"><?php previous_posts_link('Next Entries »') ?></div>  
		</div>
		
	<?php else : ?>
	 
	<!-- here's where we'll put a search form if there're no posts -->
	 	 
	 	 <p>No results for that keyword - please search again:</p>
	 	 
	 	 <div id="searchwrapper">
		 	<?php get_search_form(); ?> 
		 </div>
	
	<?php endif; ?> 

	</div>
</div>
<?php get_footer(); ?>