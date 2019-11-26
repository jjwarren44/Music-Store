<?php
include('DBConn.php')
?>
<!DOCTYPE HTML?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	 <title>Music Store</title>
	 <link href="css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="css/table.css"> <!-- Custom css file -->
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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
                    <input type="text" class="form-control" onkeyup="search()" placeholder="Search Album or Artist" id="searchBar" align="center">
                </div>
            </div>
        </div>
		<div class="row" align="center">
			<div class="col-1">
            </div>
			<div class="col-10">
                <!--Will get switched to php code//placeholder -->
				<table class="table table-borderless" id="albums" align="Center">
                    <div class = 'tableContent'>
        				<thead>
        						<tr class="table-active">
             					<th scope="col span='50%'">Album</th>
              					<th scope="col span='50%'">Artist</th>
             				</tr>
             				</thead>
                            <tbody> 

                            <!-- Begin looping through all records in database to display albums and artist -->
                            <?php

                                mysqli_begin_transaction($conn); // Start mySQLi transaction
                                $result = mysqli_query($conn, "SELECT Name, Title FROM Artist, Album WHERE Artist.ArtistId = Album.ArtistId ORDER BY AlbumId");

                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr class = 'table-active'>";
                                    echo "<td>".$row['Title']."</td>";
                                    echo "<td>".$row['Name']."</td>";
                                }

                            ?>
            				</tbody>
                        </div>
    			</table>
    		</div>
    	</div>
    </div>
</body>

<script type="text/javascript" language="javascript" src="js/table.js"></script>   <!-- javascript file -->

</html>