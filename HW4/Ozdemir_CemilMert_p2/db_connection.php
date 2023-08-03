<?php

$sname = "dijkstra.ug.bcc.bilkent.edu.tr";
$uname = "cemil.ozdemir";
$password = "ifyd3Dw5";
$db_name = "cemil_ozdemir";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn){
    echo "Connection failed!";
}

