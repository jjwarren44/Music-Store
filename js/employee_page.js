// Search function
function search() {
  	// Declare variables
  	var input, filter, table, customerName, tr, i, txtValue;
  	input = document.getElementById("searchBar");
  	filter = input.value.toUpperCase();
  	table = document.getElementById("customers");
  	tr = table.getElementsByTagName("tr");

  	// Loop through all table rows, and hide those who don't match the search query
  	for (i = 0; i < tr.length; i++) {
	    customerName = tr[i].getElementsByTagName("td")[0];
	    if (customerName) {
	      txtValue = customerName.textContent || customerName.innerText;
	      if (txtValue.toUpperCase().indexOf(filter) > -1) {
	        tr[i].style.display = "";
	      } else {
				tr[i].style.display = "none"; // no results for either album or song
	      	}
    	}
  	}
}

$(document).ready(function() {
    $(".clickable-row").click(function() {
    	//alert( $(this).attr('customerId'));
    	window.location = $(this).attr("customer-link");


    });
});

