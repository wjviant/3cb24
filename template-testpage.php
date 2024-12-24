<?php
/*
Template Name: Style Test Page
*/
?>
<?php get_header(); ?>
<div class="container">
	<div id="content" class="twelve columns clearfix">
	
		<h1>Grid &amp; Style Test</h1>
		
		<?php
			//Display the page content/body
			if ( have_posts() ) while ( have_posts() )
			{
				the_post();
				the_content();
			}
		?>
		
		<h2>Heading 2</h2>
		
		<h3>Heading 3</h3>
		
		<p>Paragraph text - <strong>Strong</strong> - <em>Emphasis</em> - Lorem ipsum dolor sit amet, 
		consectetuer adipiscing elit. Suspendisse lectus nisl, semper sit amet, blandit at, lacinia 
		et, sem. Sed pellentesque turpis ut risus. Nullam luctus sagittis urna. Vivamus nibh. Fusce
		 ut nunc. Vivamus sed felis. Nam elit diam, auctor eu, eleifend vel, dictum quis, leo. 
		 Pellentesque fringilla, tellus quis auctor nonummy, pede lorem varius massa, at vestibulum 
		 enim nibh ac massa.</p>
		 
		<p class="clearfix">
			<a class="btn btn-primary" href="#">Anchor</a> 
			<button class="btn">Button</button> 
			<input class="btn" type="submit" value="Input" />
		</p>
		
		<p class="left">Left</p>
		
		<p class="right">Right</p>
		
		<p class="clearance">Donec velit. Suspendisse rutrum nunc sed tellus. Maecenas interdum 
			placerat nulla. Etiam sit amet orci at lectus posuere nonummy. Praesent rutrum ante eget 
			nisl. Nulla bibendum sodales quam. Phasellus ipsum.</p>
			
		<p class="positive">Positive message</p>
		
		<p class="negative">Negative message</p>
		
		<ul>
			<li>List item 1</li>
			<li>List item 2</li>
			<li>List item 3</li>
		</ul>
		
		<ol>
			<li>List item 1</li>
			<li>List item 2</li>
			<li>List item 3</li>
		</ol>
		
		<blockquote><p>Blockquote - Etiam sit amet orci at lectus posuere nonummy. Praesent rutrum ante eget nisl. Nulla bibendum sodales quam. Phasellus ipsum.</p></blockquote>
		
		<pre>Preformatted Code</pre>
		
		<fieldset>
			<legend>Fieldset</legend>
			<form id="enquiry" action="" method="post" name="enquiry">
				
				<div>
					<label for="name">Name:</label>
					<input id="name" type="text" name="name" />
				</div>
				<div>
					<label for="company">Company:</label>
					<input id="company" type="text" name="company" />
				</div>
				<div>
					<label for="email">Email:</label>
					<input id="email" type="text" name="email" /></div>
				<div>
					<label for="state">State:</label>
					<div class="select-input">
						<select name="state">
							<option value="CA">California -- CA</option>
							<option value="CO">Colorado -- CO</option>
							<option value="CN">Connecticut -- CN</option>
						</select>
					</div>
				</div>
				<div>
					<label for="phone">Phone:</label>
					<input id="phone" type="text" name="phone" />
				</div>
				<div>
					<label>Your Enquiry:</label>
					<textarea id="body" cols="10" name="body" rows="4"></textarea>
				</div>
				<div>
					<input id="send" type="submit" name="send" value="Send" />
				</div>
		
			</form>
		</fieldset>
		
		<p>Abbreviation: <abbr lang="en" title="World Wide Web Consortium">W3C</abbr></p>
		
		
		<table cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th>Title</th>
					<th>Title</th>
					<th>Title</th>
					<th>Title</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Data</td>
					<td>Data</td>
					<td>Data</td>
					<td>Data</td>
				</tr>
				<tr>
					<td>Data</td>
					<td>Data</td>
					<td>Data</td>
					<td>Data</td>
				</tr>
				<tr>
					<td>Data</td>
					<td>Data</td>
					<td>Data</td>
					<td>Data</td>
				</tr>
			</tbody>
		</table>
		
		<p>Donec velit. Suspendisse rutrum nunc sed tellus. Maecenas interdum placerat nulla. 
			Etiam sit amet orci at lectus posuere nonummy. Praesent rutrum ante eget nisl. 
			Nulla bibendum sodales quam. Phasellus ipsum.</p>
		
		<div class="styletest row">
		
			<div class="one column">1
			</div>
		
			<div class="one column">2
			</div>
			
			<div class="one column">3
			</div>
			
			<div class="one column">4
			</div>
			
			<div class="one column">5
			</div>
			
			<div class="one column">6
			</div>
			
			<div class="one column">7
			</div>
			
			<div class="one column">8
			</div>
			
			<div class="one column">9
			</div>
			
			<div class="one column">10
			</div>
			
			<div class="one column">11
			</div>
			
			<div class="one column">12
			</div>
		
		</div> <!-- end 12 single columns -->
		
		<div class="styletest row">
		
			<div class="two columns">1
			</div>
		
			<div class="two columns">2
			</div>
			
			<div class="two columns">3
			</div>
			
			<div class="two columns">4
			</div>
			
			<div class="two columns">5
			</div>
			
			<div class="two columns">6
			</div>
		
		</div> <!-- end 6 double columns -->
		
		<div class="styletest row">
		
			<div class="one-quarter column">One Quarter
			</div>
		
			<div class="one-quarter column">One Quarter
			</div>
			
			<div class="one-quarter column">One Quarter
			</div>
			
			<div class="one-quarter column">One Quarter
			</div>
		
		</div> <!-- end 4 quarter columns -->
		
		<div class="styletest row">
		
			<div class="one-quarter column">One Quarter
			</div>
		
			<div class="three-quarter column">Three Quarters
			</div>
		
		</div> <!-- end 1/3 quarter columns -->
		
		<div class="styletest row">
		
			<div class="one-half column">One Half
			</div>
		
			<div class="one-half column">One Half
			</div>
		
		</div> <!-- end half columns -->
		
		
		<div class="styletest row">
		
			<div class="one-third column">One Third
			</div>
		
			<div class="one-third column">One Third
			</div>
			
			<div class="one-third column">One Third
			</div>
		
		</div> <!-- end 3 third columns -->
		
		<div class="styletest row">
		
			<div class="one-third column">One Third
			</div>
		
			<div class="two-thirds column">Two Thirds
			</div>
		
		</div> <!-- end 2 third columns -->
		
		<div class="styletest row">
		
			<div class="one-half column">
			
				<div class="styletest row">
		
					<div class="one-half column">One Half
					</div>
				
					<div class="one-half column">One Half
					</div>
				
				</div> <!-- end half columns -->
			
			</div>
		
			<div class="one-half column">One Half
			</div>
		
		</div> <!-- end half columns -->
		
	</div>
</div>
<?php get_footer(); ?>