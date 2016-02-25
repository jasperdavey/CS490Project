<?php
session_start();
    echo "test-response";
    $resultDB = file_get_contents('php://input');
    echo $resultDB;
 ?>
