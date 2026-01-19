<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'bijoy');
define('DB_PASSWORD', 'qazwsx..121');
define('DB_NAME', 'insurance_m_b');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>