<?php get_header(); ?>
<div class="container">    
    <div class="nine columns">
    
    <h1>Archives:<?php single_month_title('&nbsp;'); ?> </h1>
    
    <?php if (have_posts()) : ?>  
    
        <?php while (have_posts()) : the_post(); ?> 
         
        <div class="post" id="post-<?php the_ID(); ?>">  
        
            <h2 class="blog-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>  
 
            <div class="entry">  
                <?php the_excerpt('Read the rest of this entry »'); ?>  
            </div>  
              
            <p class="postmetadata">
            	<span class="blogcat">Posted in <?php the_category(', ') ?></span>
            	<span class="blogdate"><?php the_time('F jS, Y') ?> by <?php the_author() ?></span>     
                <span class="blogcomments"><?php comments_popup_link('No Comments »', '1 Comment »', '% Comments »'); ?></span>  
            </p>
              
        </div>  
        
        <?php endwhile; ?>
          
        <div class="navigation">  
            <div class="alignleft"><?php next_posts_link('« Previous Entries') ?></div>  
            <div class="alignright"><?php previous_posts_link('Next Entries »') ?></div>  
        </div>  
        
    <?php else : ?>  
    
        <h2 class="center">Not Found</h2>  
        
        <p class="center">Sorry, but you are looking for something that isn't here.</p>  
        
        <?php include (TEMPLATEPATH . "/searchform.php"); ?>  
        
    <?php endif; ?> 
    
    </div>
    
    <?php get_sidebar(); ?> 
</div>   
<?php get_footer(); ?> 