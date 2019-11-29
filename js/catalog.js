// Search function
function search() {
  	// Declare variables
  	var input, filter, table, album, artist, tr, i, txtValue;
  	input = document.getElementById("searchBar");
  	filter = input.value.toUpperCase();
  	table = document.getElementById("albums");
  	tr = table.getElementsByTagName("tr");

  	// Loop through all table rows, and hide those who don't match the search query
  	for (i = 0; i < tr.length; i++) {
	    album = tr[i].getElementsByTagName("td")[0];
	    if (album) {
	      txtValue = album.textContent || album.innerText;
	      if (txtValue.toUpperCase().indexOf(filter) > -1) {
	        tr[i].style.display = "";
	      } else {
		      	artist = tr[i].getElementsByTagName("td")[1];
		    	if (artist) {
		      		txtValue = artist.textContent || artist.innerText;
		      		if (txtValue.toUpperCase().indexOf(filter) > -1) {
		        		tr[i].style.display = "";
			      	} else {
			        	tr[i].style.display = "none"; // no results for either album or song
			      	}
		  		}
	      	}
    	}
  	}
}

$(document).ready(function() {
    $(".clickable-row").click(function() {
    	//alert( $(this).attr('customerId'));
    	window.location = $(this).attr("album-link");

    });
});
