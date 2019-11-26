<?php
include('DBConn.php')
?>
<!DOCTYPE HTML?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	 <title>Place holder Title</title>
	 <link href="css/bootstrap.min.css" rel="stylesheet">
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Script for handling users search -->
    <script>
    function search() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("searchBar");
      filter = input.value.toUpperCase();
      table = document.getElementById("albums");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
    </script>

</head>
<body>
    <?php
    include 'navbar.php'
    ?>
	<br>
	<br>
	<div class="container-fluid">
        <div class="row" align="center">
            <div class=col-4></div>
            <div class="col-4" align="center">
                <div class="form-group" align="center">
                    <input type="text" class="form-control" onkeyup="search()" placeholder="Search Music" id="searchBar" align="center">
                </div>
            </div>
        </div>
		<div class="row" align="center">
			<div class="col-1">
            </div>
			<div class="col-10">
                <!--Will get switched to php code//placeholder -->
				<table class="table table-borderless" id="albums" align="Center">
				<thead>
						<tr class="table-active">
     					<th scope="col">AlbumID</th>
      					<th scope="col">Album Title</th>
     					<th scope="col">ArtistID</th>
     				</tr>
     				</thead>
                    <tbody> 
                    <!-- Begin looping through all records in database to display songs and artist -->
                    <?php

                        mysqli_begin_transaction($conn); // Start mySQLi transaction
                        $result = mysqli_query($conn, "SELECT AlbumId, Title, ArtistId FROM Album");

                        $i = 0; // Counter to determine what row we are in

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class = 'table-active'>";
                            echo "<td>".$row['AlbumId']."</td>";
                            echo "<td>".$row['Title']."</td>";
                            echo "<td>".$row['ArtistId']."</td>";
                            $i++;
                        }

                    ?>
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>
</body>
</html>