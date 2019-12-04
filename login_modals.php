<?php

	// Customer login
    echo '<div class="modal fade" id="customerLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
        echo '<div class="modal-dialog modal-dialog-centered" role="document">';
            echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="exampleModalLongTitle">Customer Login</h5>';
                    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                        echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                echo '</div>';
                echo '<div class="modal-body">';
                    echo '<form action="login_form_handler.php" method="post" id="customerLogin">';
                        echo '<p>Email</p>';
                        echo '<div class="form-group row"><input type="Email" name="email" class="form-control" placeholder="Enter Email"></div>';
                        echo '<p>Password</p>';
                        echo '<div class="form-group row"><input type="Password" name="pwrd" class="form-control" placeholder="Enter Password"></div>';
                echo '</div>';
                echo '<div class="modal-footer">';
                    echo '<button type="submit" name="customerLoginSubmit" class="btn btn-primary">Log in</button>';
                    echo '</form>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';

    // Employee login
    echo '<div class="modal fade" id="employeeLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
        echo '<div class="modal-dialog modal-dialog-centered" role="document">';
            echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="exampleModalLongTitle">Employee Login</h5>';
                    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                        echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                echo '</div>';
                echo '<div class="modal-body">';
                    echo '<form action="login_form_handler.php" method="post" id="employeeLogin">';
                        echo '<p>Employee ID</p>';
                        echo '<div class="form-group row"><input type="text" name="employeeID" id="employeeIDinput" class="form-control" placeholder="Enter Employee ID"></div>';
                        echo '<p>Employee First Name</p>';
                        echo '<div class="form-group row"><input type="text" name="employeeName" id="employeeNameInput" class="form-control" placeholder="Enter First Name"></div>';
                echo '</div>';
                echo '<div class="modal-footer">';
                    echo '<button type="submit" name="employeeLoginSubmit" class="btn btn-primary">Log in</button>';
                    echo '</form>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';

?>