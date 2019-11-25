<?php
include 'DBConn.php'
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
	<div class="cotainer-fluid">
		<br>
		<div class="row text-center">
			<div class="col-md-12">
				<h1 class="display-4 text-secondary">Search for the music you want</h1>
                <h5>A catalog full of music. Find information about music! Just a few clicks away</h5>
                <button type="button" class="btn btn-secondary" href="table.html">Find Music</button>
			</div>
        </div>
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Log in</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group row"><input type="Username" name="uname" class="form-control" placeholder="Enter Username"></div>
                            <div class="form-group row"><input type="Password" name="pwrd" class="form-control" placeholder="Enter Password"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Log in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>