<?php
session_start();
echo'<nav class="navbar navbar-expand-lg navbar-light bg-light">';
echo'<a class="navbar-brand" href="index.php"><h3>Music Store</h3></a>';
echo'<div class="collapse navbar-collapse flex-md-column">';
echo'<ul class="navbar-nav ml-auto">';
echo'<li class="nav-item"><a class="nav-link" href="table.php"><h4>Catalog</h4></a></li>';
echo'<li class="nav-item"><a class="nav-link" href="#"><h4>My Account</h4></a></li>';
echo'<li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModalCenter"><h4 class="text-info">Log In</h4></a></li>';
echo '<li class="nav-item"><a class="nav-link" href="#"><h4>Employees<h4></a></li>';
echo'</ul></div></nav>';
?>