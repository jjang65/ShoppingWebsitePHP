/******s**********
    
    Name: Jinyoung JANG
    Date Created: Mar. 12. 2020
    Last Modified: Mar. 12. 2020
    Description: Toast message handling

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

