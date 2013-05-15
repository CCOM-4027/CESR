/*
 * login.js script
 * This script is included by index.php
 * This script handles and validates the form submission.
 * This script then makes an Ajax request of login_ajax.php.
 * Created by Larry Ullman
 * www.LarryUllman.com
 * For an article published at www.Peachpit.com
 */

// Do something when the document is ready:
$(function() {
	$('#loginForm').submit(function() {          // Assign an event handler to the form:
		var user, password;                      // Initialize some variables:
		if ($('#user').val().length >= 2) {      // Validate the user address:
			user = $('#user').val();             // Get the user address:
			$('#userError').remove();            // Remove the error message, if it existed:
		} 
		else { // Invalid user address!

			if (!$('#userError').length) {        // Add an error message, if one doesn't exist:
				$('#userP').append(' <span class="error" id="userError">Please enter your user address!</span>');
			}
		}

		if ($('#password').val().length > 0) {     // Validate the password:
			password = $('#password').val();
			$('#passwordError').remove();
		} 
		else {
			// Add an error message, if one doesn't exist:
			if (!$('#passwordError').length) {
				$('#passwordP').append(' <span class="error" id="passwordError">Please enter your password!</span>');
			}
		}
				
		// If appropriate, perform the Ajax request:
		if (user && password) {
	
			// Create an object for the form data:
			var data = new Object();
			data.user = user;
			data.password = password;

			// Create an object of Ajax options:
			var options = new Object();

			// Establish each setting:
			options.data = data;
			options.dataType = 'text';
			options.type = 'get';
			options.success = function(response) {
				// Worked:
				if (response == 'CORRECT') {
					// Hide the form:
					window.location.replace("index.php");
				} 

				else {
					var message;
					switch (response) {
						case 'INCORRECT':
							message = 'The submitted credentials do not match those on file!';
							break;
						case 'INCOMPLETE':
							message = 'Please provide an user address and a password!';
							break;
						case 'INVALID_user':
							message = 'Please provide your user address!';
							break;
					}

					// Update the page:
					if ($('#responseP').length) {
						$('#responseP').text(message);
					} 
					else {
						$('#loginForm').prepend('<p id="responseP" class="error">' + message + '</p>');
					}

				}	
			}; // End of success.
			options.url = 'login_ajax.php';

			// Perform the request:
			$.ajax(options);
		
		} // End of user && password IF.
		
		// Return false to prevent an actual form submission:
		return false;
		
	}); // End of form submission.

}); // End of document ready.




