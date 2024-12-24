// Slotting form
jQuery(document).ready(function() {
  var ajaxurl = 'https://'+window.location.host+'/wp-admin/admin-ajax.php';
  
  // Find my username
  var name = jQuery(this).find(".memberName:first").val();
  //console.log(name);
  // Build an array of people already slotted in slotMember 
  // nope var slottedNames = jQuery('#slotTool').find(".slotMember").toArray();
  
  var slottedNames = jQuery('.slotMember').map(function(){
	return jQuery(this).text()
  }).get();
  
  //console.log(slottedNames);
  
  // Then if i'm in that list, set a variable to say im already slotted
  var isAlreadySlotted = '';
  //if (jQuery.inArray(name, slottedNames) != -1)
  if (slottedNames.indexOf(name) > -1)
  {	
	  console.log('is slotted somewhere');
	  isAlreadySlotted = 'true';
  } else {
	  console.log('isnt slotted somewhere');
	  isAlreadySlotted = 'false';
  }
  
  // jQuery(".slotForm").submit(function(event) {
  jQuery(document).on("submit", '.slotForm', function(event) { 
  
	event.preventDefault();
	
	var formID = jQuery(this).parent().attr('id');
	var form = jQuery(this);
	
	var currentlySlotted = jQuery("#"+formID).find(".slotMember").text(); 
	var name = jQuery(this).find(".memberName").val();
	var postID = jQuery(this).find(".postID").val();
	var acfPath = jQuery(this).find(".acfPath").val();
	//var profilePic = jQuery(this).find(".profilePic").val();
	
	console.log(isAlreadySlotted);
	
	//console.log(formID);
	//console.log('currently slotted: '+currentlySlotted);
	//console.log('member name: '+name);
	//console.log('post: '+postID);
	//console.log('acf path: '+acfPath);

	// Slot is empty
	if (currentlySlotted == '' && isAlreadySlotted == 'false')  {
		console.log ('slot was empty, now filling it');
		jQuery.ajax({
	  		traditional: true,
	  		url: ajaxurl + "?action=test_function",
	  		type: 'post',
	  		dataType: "json",
	  		// build query string manually as the serialize was URI encoding the commas
	  		data: 'acf-path='+acfPath+'&post-id='+postID+'&member-name='+name,  
	  		success: function(data) {
				console.log("SUCCESS!");
				
				// Update avatar on page
				// jQuery("#"+formID).find("input.slotIcon").css("background-image", "url(" + profilePic + ")");
				// Update member name on page
				// jQuery("#"+formID).find(".slotMember").html(name);
				
				// Reload the slot with AJAX
				jQuery('#'+formID).load(document.URL +  ' #'+formID+'>*' );
				
				console.log('added');
				isAlreadySlotted = 'true';
				
				// message
				jQuery.toast({
				  content: "Slotted"
				})
	  		},
	  		error: function(data) {
				console.log("FAILURE");
	  		}
		});
	} else if (currentlySlotted == name ){
		console.log ('is already slotted');
		// delete user but only if it's me
		name = '',
		jQuery.ajax({
		  	traditional: true,
		  	url: ajaxurl + "?action=test_function",
		  	type: 'post',
		  	dataType: "json",
		  	// build query string manually as the serialize was URI encoding the commas
		  	
		  	data: 'acf-path='+acfPath+'&post-id='+postID+'&member-name='+name,  
		  	success: function(data) {
				console.log("SUCCESS!");
				
				// Update avatar on page
				// jQuery("#"+formID).find("input.slotIcon").css("background-image", "none");
				// Update member name on page
				// jQuery("#"+formID).find(".slotMember").html(name);
				
				// Reload the slot with AJAX
				jQuery('#'+formID).load(document.URL +  ' #'+formID+'>*' );
				
				isAlreadySlotted = 'false';
				console.log('removed');
				// message
				jQuery.toast({
				  content: "Unslotted"
				})
		  	},
		  	error: function(data) {
				console.log("FAILURE");
		  	}
		});
	
		
	} else {
		
		if(isAlreadySlotted == 'false' ) {
			console.log('do nothing, its not me');
			// message
			jQuery.toast({
			  content: "Slot taken"
			})
		} 

		if(isAlreadySlotted == 'true') {
			console.log('im already slotted somewhere else');
			// message
			jQuery.toast({
			  content: "You're already slotted"
			})
		}
				
	}
	
  });
});




// RSVP (Un)register form
jQuery(document).ready(function() {
	
    //jQuery(".rsvpFormUnregister").submit(function(event) {
	jQuery(document).on("submit", '.rsvpFormUnregister', function(event) { 
		
		event.preventDefault();
		
		var ajaxurl = 'https://'+window.location.host+'/wp-admin/admin-ajax.php';
		
		var rsvpFormID = jQuery(this).parent().attr('id');
		var rsvpForm = jQuery(this);
		
		var rsvpMemberName = jQuery(this).find(".rsvpMemberName").val();
		var rsvpUserID = +jQuery(this).find(".rsvpUserID").val();
		var rsvpPostID = +jQuery(this).find(".rsvpPostID").val();
		var rsvpAcfPath = jQuery(this).find(".rsvpAcfPath").val();
		var rsvpAllUsers = jQuery(this).find(".rsvpAllUsers").val();
		
		var parsedUsers = JSON.parse(rsvpAllUsers);
		
		//console.log('member name: '+rsvpMemberName);
		//console.log('post: '+rsvpPostID);
		//console.log('acf path: '+rsvpAcfPath);
		//console.log('all users as string: '+JSON.stringify(parsedUsers));
			
		// Am I already RSVPd? 
		if(jQuery.inArray(rsvpUserID, parsedUsers.user) !== -1) {
			
			//console.log('im rsvpd - remove me');
			
			// filter me out of the user array
			parsedUsers.user = parsedUsers.user.filter(test);
			function test(blah) {
				return blah !== rsvpUserID;
			} 
			
		} else {
			
			//console.log('im not rsvpd - add me');
			
			// Init array if there are no existing users
			if (parsedUsers.user === false ) {
				//console.log('no users');
				parsedUsers.user = new Array();
				//console.log(parsedUsers.user); 
			}
			
			// Add me to the user array
			parsedUsers.user.push(rsvpUserID);
			
		}
	
	
		// Send data back to PHP function that updates ACF database	
		jQuery.ajax({
			
			url: ajaxurl + "?action=rsvp_function_unreg",  
			type: 'post',
			dataType: "json",
			cache: false,
			data: 'all-users='+parsedUsers.user+'&acf-path='+rsvpAcfPath+'&post-id='+rsvpPostID,
	  	
	  		cache: false,
	  	
	  		success: function(data) {
		  	console.log("SUCCESS!");
			  	//jQuery("#attendanceRoster .wrap").animate({'opacity': 0}, 0);
				// Reload the attendance roster part of the page with AJAX
				jQuery('#attendanceRoster').load(document.URL +  ' #attendanceRoster>*' , function(){
					//jQuery("#attendanceRoster .wrap").animate({'opacity': 1}, 0);
				});
				//location.reload(true);
				
	    	},
	    	error: function(data) {
				console.log("FAILURE");
	    	}
			
		});

    }); // end ajax function

}); // end doc ready function