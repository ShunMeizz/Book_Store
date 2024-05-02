<?php
    $connection = new mysqli ('localhost', 'root','dbsebialf2');

    if(!$connection){
        die(mysqli_error($mysqli))
    }