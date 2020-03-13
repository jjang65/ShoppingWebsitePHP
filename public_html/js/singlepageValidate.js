// Add document load event listener
document.addEventListener("DOMContentLoaded", load);

function load(){

	console.log("load() is called");

	// increment item quantity by 1
	document.getElementById("plus_button").addEventListener("click", 
		function(){
			incrementItem();
		}
	);

	// decrement item quantity by 1
	document.getElementById("minus_button").addEventListener("click", 
		function(){
			decrementItem();
		}
	);
	
}

function incrementItem(){
	console.log("incrementItem() is called");
	let quantity = document.getElementById("quantity");
	let quantityValue = quantity.value;
	quantityValue++;
	console.log(quantityValue);
	quantity.setAttribute("value", quantityValue);
}

function decrementItem(){
	console.log("decrementItem() is called");
	let quantity = document.getElementById("quantity");
	let quantityValue = quantity.value;
	quantityValue--;
	console.log(quantityValue);
	quantity.setAttribute("value", quantityValue);
}

