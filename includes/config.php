<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'forazite_insurance');
define('DB_PASSWORD', 'forazite_insurance..121');
define('DB_NAME', 'forazite_insurance');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>