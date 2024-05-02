<?php
    $connection = new mysqli('localhost', 'root','','dbgaklatbookstore');
    if(!$connection){
        die(mysqli_error($mysqli));
    }  
?>