<?php

define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "tasktracker");

$connection = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);

if (!$connection) {
    die("Not connected...");
}

