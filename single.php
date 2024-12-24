<?php get_header(); ?>
<div class="container">    
    <div class="nine columns">
    
    	<?php if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>
    
    <?php if (have_posts()) : ?>  
    
        <?php while (have_posts()) : the_post(); ?> 
         
        <div class="post" id="post-<?php the_ID(); ?>">  
        	
        	<?php if ( has_post_thumbnail()) : ?>
					<div class="newsthumb">
						<img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>"> 
					</div> 
					<?php endif; ?>
        	
          <h1 class="blog-title"><?php the_title(); ?></h1>  
					
					<p class="postmetadata clear">
            <span class="blogcat">Posted in <?php the_category(', ') ?></span><span class="blogdate">   
            <?php the_time('F jS, Y') ?> </span>    
          </p>
					
          <div class="entry">   
          	<?php the_content(); ?>  
          </div>  
    
        </div>  
        
        <?php comments_template(); ?> 
        
        <?php endwhile; ?>        
    <?php endif; ?> 
    
    </div>
    
    <?php get_sidebar(); ?> 
</div>    
<?php get_footer(); ?> 