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

	// Add event listener for the form submit
	document.getElementById("registerform").addEventListener("submit", validate, false);

	// Reset the from using the default browser reset
	// This is doen to ensure the radio buttons are unchecked when the Page is refreshed
	// This line of code must be done before attacing the event listener for the customer reset
	document.getElementById("registerform").reset();

	// Add event listener for the form reset
	document.getElementById("registerform").addEventListener("reset", resetForm, false);

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
	console.log(e.cancelable);
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
		document.getElementById("email").focus();
		
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

	// check if email field has any input
	errorFlag = validateRequiredField("email", errorFlag);

	// Create a regular expression for email
	let regexForEmail = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);

	let emailFieldValue = document.getElementById("email").value;

	// Determine if the value passes the regexForAddress
	if(!regexForEmail.test(emailFieldValue)){
		// Display the appropriate error message
		document.getElementById("emailformat_error").style.display = "block";	
		if(!errorFlag){
			email.focus();
			email.select();
		}

		// Raise the error flag
		errorFlag = true;
	}

	// check if password field has any input
	errorFlag = validateRequiredField("password", errorFlag);

	const password = document.getElementById("password")

	// check for password complexity
	let regexForPassword = new RegExp("(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}");
	let passwordFieldValue = password.value;
	var lowerCaseLetters = /[a-z]/g;
	var upperCaseLetters = /[A-Z]/g;
	var numbers = /[0-9]/g;
	if(!((passwordFieldValue.match(lowerCaseLetters) && passwordFieldValue.match(upperCaseLetters)
		&& passwordFieldValue.match(numbers) && (passwordFieldValue.length >= 8)))) {
    	// Display the appropriate error message
		document.getElementById("password_complex_error").style.display = "block";	
		if(!errorFlag){
			password.focus();
			password.select();
		}

		errorFlag = true;
	}




	// check if confirm field has any input
	errorFlag = validateRequiredField("confirm", errorFlag);

	// check if password and confirm fileds' values are matched
	const confirm = document.getElementById("confirm");
	let confirmFieldValue = confirm.value;
	console.log(passwordFieldValue + ' + ' + confirmFieldValue);
	if(passwordFieldValue != confirmFieldValue) {
		// Display the appropriate error message
		document.getElementById("confirm_matched_error").style.display = "block";	
		if(!errorFlag){
			confirm.focus();
			confirm.select();
		}

		errorFlag = true;
	}

	//return the error flag
	return errorFlag;

}


/*
 * Validates a required filed has any input.
 *
 * return   True if an error was found;
 */
function validateRequiredField(fieldname, errorFlag) {
	let required = document.getElementById(fieldname);
	if(!formFieldHasInput(required)){
		// Display the appropriate error message
		document.getElementById(fieldname + '_error').style.display = "block";
		if(!errorFlag){
			required.focus();
			required.select();
		}

		// Raise the error flag
		errorFlag = true;
	}

	return errorFlag;
}