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
                    <input type="text" class="form-control" placeholder="Search Music" id="inputDefault" align="center">
                </div>
            </div>
        </div>
		<div class="row" align="center">
			<div class="col-1">
            </div>
			<div class="col-10">
                <!--Will get switched to php code//placeholder -->
				<table class="table table-borderless" align="Center">
				<thead>
						<tr class="table-active">
						<th scope="col">#</th>
     					<th scope="col">Song</th>
      					<th scope="col">Artist</th>
     					<th scope="col">Album</th>
                        <th scope="col">Genre</th>
     				</tr>
     				</thead>
     				<tbody>
     					<tr class="table-active">
    					<th scope="row">1</th>
    					<td>Gravity</td>
    					<td>Against the Current</td>
    					<td>Gravity</td>
                        <td>Rock</td>
    				</tr>
    				<tr class="table-active">
    					<th scope="row">2</th>
    					<td>FireProof</td>
    					<td>Against the Current</td>
    					<td>Gravity</td>
                        <td>rock</td>
    				</tr>
    				<tr class="table-active">
    					<th scope="row">3</th>
    					<td>Paralyzed</td>
    					<td>Against the Current</td>
    					<td>Gravity</td>
                        <td>Rock</td>
    				</tr>
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>
</body>
</html>