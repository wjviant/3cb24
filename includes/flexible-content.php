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
		
		<!-- Root element of PhotoSwipe. Must have class pswp. -->
		<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
		
	    <!-- Background of PhotoSwipe. 
	         It's a separate element as animating opacity is faster than rgba(). -->
	    <div class="pswp__bg"></div>
	
	    <!-- Slides wrapper with overflow:hidden. -->
	    <div class="pswp__scroll-wrap">
	
        <!-- Container that holds slides. 
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

          <div class="pswp__top-bar">

            <!--  Controls are self-explanatory. Order can be changed. -->
            <div class="pswp__counter"></div>

            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

            <button class="pswp__button pswp__button--share" title="Share"></button>

            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

            <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
            <!-- element will get class pswp__preloader--active when preloader is running -->
            <div class="pswp__preloader">
                <div class="pswp__preloader__icn">
                  <div class="pswp__preloader__cut">
                    <div class="pswp__preloader__donut"></div>
                  </div>
                </div>
            </div>
          </div>

          <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
              <div class="pswp__share-tooltip"></div> 
          </div>

          <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
          </button>

          <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
          </button>

          <div class="pswp__caption">
              <div class="pswp__caption__center"></div>
          </div>

        </div>
	
	    </div>
		
		</div>
		
		<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/photoswipe.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/photoswipe-ui-default.min.js"></script>
		
		<script>
		
			var initPhotoSwipeFromDOM = function(gallerySelector) {

    // parse slide data (url, title, size ...) from DOM elements 
    // (children of gallerySelector)
    var parseThumbnailElements = function(el) {
        var thumbElements = el.childNodes,
            numNodes = thumbElements.length,
            items = [],
            figureEl,
            linkEl,
            size,
            item;

        for(var i = 0; i < numNodes; i++) {

            figureEl = thumbElements[i]; // <figure> element

            // include only element nodes 
            if(figureEl.nodeType !== 1) {
                continue;
            }

            linkEl = figureEl.children[0]; // <a> element

            size = linkEl.getAttribute('data-size').split('x');

            // create slide object
            item = {
                src: linkEl.getAttribute('href'),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10)
            };



            if(figureEl.children.length > 1) {
                // <figcaption> content
                item.title = figureEl.children[1].innerHTML; 
            }

            if(linkEl.children.length > 0) {
                // <img> thumbnail element, retrieving thumbnail url
                item.msrc = linkEl.children[0].getAttribute('src');
            } 

            item.el = figureEl; // save link to element for getThumbBoundsFn
            items.push(item);
        }

        return items;
    };

    // find nearest parent element
    var closest = function closest(el, fn) {
        return el && ( fn(el) ? el : closest(el.parentNode, fn) );
    };

    // triggers when user clicks on thumbnail
    var onThumbnailsClick = function(e) {
        e = e || window.event;
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var eTarget = e.target || e.srcElement;

        // find root element of slide
        var clickedListItem = closest(eTarget, function(el) {
            return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
        });

        if(!clickedListItem) {
            return;
        }

        // find index of clicked item by looping through all child nodes
        // alternatively, you may define index via data- attribute
        var clickedGallery = clickedListItem.parentNode,
            childNodes = clickedListItem.parentNode.childNodes,
            numChildNodes = childNodes.length,
            nodeIndex = 0,
            index;

        for (var i = 0; i < numChildNodes; i++) {
            if(childNodes[i].nodeType !== 1) { 
                continue; 
            }

            if(childNodes[i] === clickedListItem) {
                index = nodeIndex;
                break;
            }
            nodeIndex++;
        }



        if(index >= 0) {
            // open PhotoSwipe if valid index found
            openPhotoSwipe( index, clickedGallery );
        }
        return false;
    };

    // parse picture index and gallery index from URL (#&pid=1&gid=2)
    var photoswipeParseHash = function() {
        var hash = window.location.hash.substring(1),
        params = {};

        if(hash.length < 5) {
            return params;
        }

        var vars = hash.split('&');
        for (var i = 0; i < vars.length; i++) {
            if(!vars[i]) {
                continue;
            }
            var pair = vars[i].split('=');  
            if(pair.length < 2) {
                continue;
            }           
            params[pair[0]] = pair[1];
        }

        if(params.gid) {
            params.gid = parseInt(params.gid, 10);
        }

        return params;
    };

    var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
        var pswpElement = document.querySelectorAll('.pswp')[0],
            gallery,
            options,
            items;

        items = parseThumbnailElements(galleryElement);

        // define options (if needed)
        options = {

            // define gallery index (for URL)
            galleryUID: galleryElement.getAttribute('data-pswp-uid'),
						
						// Turn off share button
						shareEl: false,
						
            getThumbBoundsFn: function(index) {
                // See Options -> getThumbBoundsFn section of documentation for more info
                var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect(); 

                return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
            }

        };

        // PhotoSwipe opened from URL
        if(fromURL) {
            if(options.galleryPIDs) {
                // parse real index when custom PIDs are used 
                // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                for(var j = 0; j < items.length; j++) {
                    if(items[j].pid == index) {
                        options.index = j;
                        break;
                    }
                }
            } else {
                // in URL indexes start from 1
                options.index = parseInt(index, 10) - 1;
            }
        } else {
            options.index = parseInt(index, 10);
        }

        // exit if index not found
        if( isNaN(options.index) ) {
            return;
        }

        if(disableAnimation) {
            options.showAnimationDuration = 0;
        }

        // Pass data to PhotoSwipe and initialize it
        gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    };

    // loop through all gallery elements and bind events
    var galleryElements = document.querySelectorAll( gallerySelector );

    for(var i = 0, l = galleryElements.length; i < l; i++) {
        galleryElements[i].setAttribute('data-pswp-uid', i+1);
        galleryElements[i].onclick = onThumbnailsClick;
    }

    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = photoswipeParseHash();
    if(hashData.pid && hashData.gid) {
        openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
    }
};

// execute above function
initPhotoSwipeFromDOM('.mygallery');
			
		</script>
		
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