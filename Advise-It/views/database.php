<?php

$database = "aperciv1_adviseit";
$user = "aperciv1_adviseit";
$password = "ah*Gk^SSOCi]";

$host = "localhost";
$cnxn = mysqli_connect($host, $user, $password, $database)
    or die("Error connecting to db");

/*
 * $sql = "INSERT INTO advise (token, fall, winter, spring, summer)
        VALUES ('000001', 'sdev305', 'sdev101', 'com101', 'bus&100')";
*/
mysqli_query($cnxn, $sql);