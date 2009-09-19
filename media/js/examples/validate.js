// Prepare the form when the DOM is ready 
$(document).ready(function() { 
	var options = {
		beforeSubmit:  request,   // Pre-submit callback 
		success:       response,  // Post-submit callback
		dataType:      'json',    // 'xml', 'script', or 'json' (expected server response type)
		timeout:       3000       // Pause... so we can see the cool loading image :)
	}; 
 
    // Bind to the form's submit event 
    $('#frm_validate').submit(function() { 
        // Inside event callbacks 'this' is the DOM element so we first 
        // wrap it in a jQuery object and then invoke ajaxSubmit 
        $(this).ajaxSubmit(options); 
 
        // !!! Important !!! 
        // Always return false to prevent standard browser submit and page navigation 
        return false; 
    }); 
});

/**
 * Pre-submit callback
 * 
 * @param	{Object}	formData
 * @param	{Object}	jqForm
 * @param	{Object}	options
 */ 
function request(formData, jqForm, options) { 
	// Show the loading display
	$('#loading').show();
 
    // here we could return false to prevent the form from being submitted; 
    // returning anything other than false will allow the form submit to continue 
    return true; 
} 

/**
 * Post-submit callback 
 * 
 * @param	{Object}	response objext
 * @param	string		status text
 */
function response(response, status)  { 
	// Hide the loading display
	$('#loading').hide();
	
	// Successful request?
	if (status == "success") {		
		// Remove all error css from the fields
		jQuery.each($('input[type=text], input[type=password]'), function() {
			$(this).removeClass('error');
		});
		// Hide all of the error details
		jQuery.each($('.detail'), function() {
			$(this).hide();
		});
			
		if (response.success) {
			alert('Successful Validation!');
		}
		else {			
			// Set error style for the fields that failed
			jQuery.each(response.errors, function(key, val) {
				$('#'+key).addClass('error'); 
				detail = $('#'+key+'_detail');
				detail.html(val); 
				detail.show();				
			});
		}
	}
}