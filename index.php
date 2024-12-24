<?php get_header(); ?>
<div class="container">    
    <div class="twelve columns">
    
    <h1>News &amp; Blog</h1>
    
    <?php if (have_posts()) : ?>  
    <div class="row">
        <?php while (have_posts()) : the_post(); ?> 
         
        <div class="post" id="post-<?php the_ID(); ?>" >  
        
          <h3 class="blog-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>  
 
					<?php if ( has_post_thumbnail()) : ?>
					<div class="newsthumb">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
							<img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>"> 
						</a>
					</div> 
					<?php endif; ?>
 
          <div class="entry">  
              <?php the_excerpt(); ?>  
          </div>  
            
          <p class="postmetadata clear">
          	<span class="blogcat">Posted in <?php the_category(', ') ?></span>
          	<span class="blogdate"><?php the_time('F jS, Y') ?></span>      
          </p>
              
        </div>  
        
        <?php endwhile; ?>
          
        <div class="navigation">  
            <div class="navlink"><?php next_posts_link('« Previous Entries') ?></div>  
            <div class="navlink"><?php previous_posts_link('Next Entries »') ?></div>  
        </div>  
    </div>   
    <?php else : ?>  
    
        <h2 class="center">Not Found</h2>  
        
        <p class="center">Sorry, but you are looking for something that isn't here.</p>  
        
        <?php include (TEMPLATEPATH . "/searchform.php"); ?>  
        
    <?php endif; ?> 
    
    </div>
</div>  
<?php get_footer(); ?> 