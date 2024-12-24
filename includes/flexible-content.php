<?php
// Flexible Content Rows

if( have_rows('flexible_content') ){
	$field_object = get_field_object('flexible_content');
	
	$total_rows = count($field_object['value']);
	$counter = 0;
	while ( have_rows('flexible_content') ){
		
		the_row(); 
		$counter++; ?>

		<?php  // Full row 
		if( get_row_layout() == 'full' ){ ?>
		<section class="full clearfix">
			<div class="text">
				<?php the_sub_field('content'); ?>
			</div>
		</section>
		<?php }  // end full row
		   
		
		elseif( get_row_layout() == 'filler' ){?>
			<div id="panel<?php echo $counter;?>" class="filler <?php the_sub_field('background'); ?>"></div>
		<?php }
		   
		   
		elseif( get_row_layout() == 'banner_block' ){ ?>
		<section class="banners clear slider">
			<picture>
			<source media="(max-width:599px)" srcset="<?php the_sub_field('mobile_banner');?>">
				<source media="(min-width:600px)" srcset="<?php the_sub_field('desktop_banner');?>">
				<img src="<?php the_sub_field('mobile_banner');?>" alt="<?php the_title();?>">
			</picture>
				
			
				<div class="inner">		
					<div class="container">
					<div class="twelve columns">
						<?php the_sub_field('banner_text'); ?>
					</div>
					</div>
				</div>			
			   
				
		</section>
		<?php } 
	
	
		elseif( get_row_layout() == 'filler' ){?>
			<section class="filler"></section>
		<?php }
			
		  
		elseif( get_row_layout() == 'testimonial' ){?>
		<section class="testimonials">
			<div class="container">
				<div class="slides">
				<?php if( have_rows('testimonials') ){

			  while ( have_rows('testimonials') ) : 
			  the_row(); ?>

				<div class="testimonial">	
					<blockquote>
						<?php the_sub_field('testimonial_text');?>
						<cite>
							<?php the_sub_field('testimonial_name');?>
							</cite>			
					</blockquote>
				</div> 
			
			  <?php endwhile;
			
				} else { ?>
			
			  <p class="negative">Please add some testimonials!</p>
			
				<?php }	?>
				</div>
			</div>
		</section>
		<?php }
	
	
		
		
		  
		elseif( get_row_layout() == 'faq' ){?>
		<section class="faqs">
			<div class="container">
				<div class="twelve columns">
				<?php if( have_rows('faqs') ){

			  while ( have_rows('faqs') ) : 
			  the_row(); ?>

				<div class="faq">	
					<h2 class="faq-question"><?php the_sub_field('faq_question');?></h2>	
					<div class="faq-answer">
						<?php the_sub_field('faq_answer');?>
					</div>			
				</div> 
			
			  <?php endwhile;
			
				} else { ?>
			
			  <p class="negative">Please add some FAQs!</p>
			
				<?php }	?>
				</div>
			</div>
		</section>
		<?php } 	
	
	
		elseif( get_row_layout() == 'boxes' ){?>
		<section id="panel<?php echo $counter;?>" class="boxes <?php the_sub_field('classes');?> <?php the_sub_field('background'); ?>">
			<div class="container grid <?php the_sub_field('vertical_align'); ?>">
				<?php if( have_rows('boxes') ){
				  while ( have_rows('boxes') ) { 
					  the_row(); ?>
					<div class="box <?php the_sub_field('class');?>">	
						<?php the_sub_field('content');?>
					</div> 
				  <?php }
				} else { ?>
				<p class="negative">Please add some boxes!</p>
				<?php }	?>
		
			</div>
		</section>
		<?php }
	
		 
		elseif( get_row_layout() == 'text_and_image_block' ){?>
		<section class="text-and-image clear clearfix" style="background-image:url(<?php the_sub_field('text_and_image_block_image'); ?>);">
			<div class="container">
				<div class="text-block <?php the_sub_field('textbox_location'); ?>">
					<?php the_sub_field('text_and_image_block_content'); ?>
				</div>	
			</div>
		</section>
		<?php } 	
	
	
	
	
		   
		elseif( get_row_layout() == 'gallery' ){?>
		<section class="clearfix gallery" >
			<div class="container" >			
			<?php  if( get_sub_field('title') ) { ?>
			<h2><?php the_sub_field('title'); ?></h2>
			<?php } ?>
				<div class="mygallery" itemscope itemtype="http://schema.org/ImageGallery">
				<?php
				//$counter = 1;
				$images = get_sub_field('images');
				if($images){
					foreach($images as $image){
				?>
				<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="one-quarter column" data-match-height="gallery-<?php echo $counter; ?>">			
					<a href="<?php echo $image['sizes']['large']; ?>" itemprop="contentUrl" data-size="<?php echo $image['width']; ?>x<?php echo $image['height']; ?>">
						<img src="<?php echo $image['sizes']['medium']; ?>" itemprop="thumbnail" alt="gallery image"/>
						<div class="overlay">
							<div class="expand">
								<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/icon-zoom.svg" alt="zoom icon">
							</div>
						</div>
					</a>	
				</figure>
				<?php
					//$counter++;
					}
				}
				?>
				</div>
			</div>
		</section>
		
		<?php } // End Gallery Row 
				
				
		
		elseif( get_row_layout() == 'three_column' ){ ?>
		<section class="clearfix threeColumn">
			<div class="container">
				<div class="one-third column">
					<?php the_sub_field('content_left'); ?>
				</div>
				<div class="one-third column">
					<?php the_sub_field('content_middle'); ?>
				</div>
				<div class="one-third column">
					<?php the_sub_field('content_right'); ?>
				</div>
				
			</div>
		</section>
		<?php } 
			
			
		elseif( get_row_layout() == 'two_column' ){ ?>
		<section class="clearfix twoColumn">
			<div class="container">
				<div class="one-half column">
					<?php the_sub_field('content_left'); ?>
				</div>
				<div class="one-half column">
					<?php the_sub_field('content_right'); ?>
				</div>
				
			</div>
		</section>
		<?php } 	
		
		
		
		elseif( get_row_layout() == 'fifty_fifty' ){ ?>
		<section class="clearfix fiftyFifty">
			<div class="container <?php if( get_sub_field('flip')) { echo 'flip'; } ?>">
				<div class="box text">
					<?php the_sub_field('content_left'); ?>
				</div>
				<div class="box">
					<img src="<?php the_sub_field('image'); ?>" alt="">
				</div>
				
			</div>
		</section>
		<?php }	
	
		
		
	} // end while
		
} else { ?>
	<!-- no flex layouts -->
<?php } // end if ?> 