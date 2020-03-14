/******s**********
    
    Name: Jinyoung JANG
    Date Created: July. 30. 2019
    Last Modified: Mar. 12. 2020
    Description: form validations

*****************/


// Add document load event listener
document.addEventListener("DOMContentLoaded", load);


/*
 * Handles the load event of the document.
 */
function load()
{
	console.log("JAVASCRIPT: load() is called");
	// Hide all errors
	hideAllErrors();

	// Add event listener for the form submit triggered by Paypal Image
	document.getElementById("orderform").addEventListener("submit", validate, false);

	// Reset the from using the default browser reset
	// This is doen to ensure the radio buttons are unchecked when the Page is refreshed
	// This line of code must be done before attacing the event listener for the customer reset
	document.getElementById("orderform").reset();

	// Add event listener for the form reset
	document.getElementById("orderform").addEventListener("reset", resetForm, false);

}

/*
 * Handles the submit event of the survey form
 *
 * param e  A reference to the event object
 * return   True if no validation errors; 
 			False if the form has validation errors
 */
function validate(e)
{
	// Hides all error elements on the page
	hideAllErrors();

	// Determine if the form has errors
	if(formHasErrors()){
		// Prevents the form from submitting
		e.preventDefault();
		// Returning false prevents the form from submitting
		return false;
	}

	return true;
}


/*
 * Handles the reset event for the form.
 *
 * param e  A reference to the event object
 * return   True allows the reset to happen; False prevents
 *          the browser from resetting the form.
 */
function resetForm(e)
{
	// Confirm that the user wants to reset the form.
	if ( confirm('Clear?') )
	{
		// Ensure all error fields are hidden
		hideAllErrors();
		
		// Set focus to the first text field on the page
		document.getElementById("firstname").focus();
		
		// When using onReset="resetForm()" in markup, returning true will allow
		// the form to reset
		return true;
	}

	// Prevents the form from resetting
	e.preventDefault();
	
	// When using onReset="resetForm()" in markup, returning false would prevent
	// the form from resetting
	return false;	
}


/*
 * Hides all of the error elements.
 */
function hideAllErrors()
{
	// Get an array of error elements
	let error = document.getElementsByClassName("error");

	// Loop through each element in the error array
	for ( let i = 0; i < error.length; i++ )
	{
		// Hide the error element by setting it's display style to "none"
		error[i].style.display = "none";
	}
}

/*
 * Removes white space from a string value.
 *
 * return  A string with leading and trailing white-space removed.
 */
function trim(str) 
{
	// Uses a regex to remove spaces from a string.
	return str.replace(/^\s+|\s+$/g,"");
}


/*
 * Determines if a text field element has input
 *
 * param   fieldElement A text field input element object
 * return  True if the field contains input; False if nothing entered
 */
 function formFieldHasInput(fieldElement){
 	// check if the text field has a value
 	if(fieldElement.value == null || trim(fieldElement.value) == ""){
 		// Invalid entry
 		return false;
 	}

 	// Valid entry
 	return true;
 }



/*
 * Does all the error checking for the form.
 *
 * return   True if an error was found; False if no errors were found
 */
function formHasErrors()
{
	// Set errorFlag as false
	let errorFlag = false;

	// Check if fullname, address, city are empty or not
	let requiredTextFields = ["firstname", "lastname"];


	for(let i = 0; i < requiredTextFields.length; i++){
		var textField = document.getElementById(requiredTextFields[i]);

		if(!formFieldHasInput(textField)){
			// Display the appropriate error message
			document.getElementById(requiredTextFields[i] + "_error").style.display = "block";
			if(!errorFlag){
				textField.focus();
				textField.select();
			}

			// Raise the error flag
			errorFlag = true;
		}
	}


	// Check if Address is empty or not
	let address = document.getElementById("address");
	if(!formFieldHasInput(address)){
		// Display the appropriate error message
		document.getElementById("address_error").style.display = "block";
		if(!errorFlag){
			address.focus();
			address.select();
		}

		// Raise the error flag
		errorFlag = true;
	}

	// Check if touncity is empty or not
	let towncity = document.getElementById("towncity");
	if(!formFieldHasInput(towncity)){
		// Display the appropriate error message
		document.getElementById("towncity_error").style.display = "block";
		if(!errorFlag){
			towncity.focus();
			towncity.select();
		}

		// Raise the error flag
		errorFlag = true;
	}


	// Check if Postal Code is empty or not
	let postal = document.getElementById("postal");
	if(!formFieldHasInput(postal)){
		// Display the appropriate error message
		document.getElementById("postal_error").style.display = "block";
		if(!errorFlag){
			postal.focus();
			postal.select();
		}

		// Raise the error flag
		errorFlag = true;
	}

	
	// Create a regular expression for postal code
	let regexForAddress = new RegExp(/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/);

	let postalFieldValue = document.getElementById("postal").value;

	// Determine if the value passes the regexForAddress
	if(!regexForAddress.test(postalFieldValue)){
		// Display the appropriate error message
		document.getElementById("postalformat_error").style.display = "block";
		if(!errorFlag){
			postal.focus();
			postal.select();
		}

		// Raise the error flag
		errorFlag = true;
	}


	// Check if Phone is empty or not
	let phone = document.getElementById("phone");
	if(!formFieldHasInput(phone)){
		// Display the appropriate error message
		document.getElementById("phone_error").style.display = "block";
		if(!errorFlag){
			phone.focus();
			phone.select();
		}

		// Raise the error flag
		errorFlag = true;
	}

	// Create a regular expression for phone
	let regexForPhone = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

	let phoneFieldValue = document.getElementById("phone").value;

	// Determine if the value passes the regexForAddress
	if(!regexForPhone.test(phoneFieldValue)){
		// Display the appropriate error message
		document.getElementById("phoneformat_error").style.display = "block";
		if(!errorFlag){
			postal.focus();
			postal.select();
		}

		// Raise the error flag
		errorFlag = true;
	}


	// // Check if email is empty or not
	// let email = document.getElementById("email");
	// if(!formFieldHasInput(email)){
	// 	// Display the appropriate error message
	// 	document.getElementById("email_error").style.display = "block";
	// 	if(!errorFlag){
	// 		email.focus();
	// 		email.select();
	// 	}

	// 	// Raise the error flag
	// 	errorFlag = true;
	// }

	// // Create a regular expression for email
	// let regexForEmail = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);

	// let emailFieldValue = document.getElementById("email").value;

	// // Determine if the value passes the regexForAddress
	// if(!regexForEmail.test(emailFieldValue)){
	// 	// Display the appropriate error message
	// 	document.getElementById("emailformat_error").style.display = "block";	
	// 	if(!errorFlag){
	// 		email.focus();
	// 		email.select();
	// 	}

	// 	// Raise the error flag
	// 	errorFlag = true;
	// }

	//Raise the error flag
	return errorFlag;
}