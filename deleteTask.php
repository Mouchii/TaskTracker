<?php
include("tasktrackerdb.php");


if (isset($_GET['userID']) && isset($_GET['taskID'])) {
    $uID = $_GET['userID'];
    $tID = $_GET['taskID'];
    $query = "DELETE FROM `tasks` WHERE `UserID` = '$uID' AND `TaskID` = '$tID'";
    $result = mysqli_query($connection, $query);
}

if (!$result) {
    // die("Query Failed".mysqli_error($connection));
    die("Query Failed");
} else {
    header("Location: home.php?id=" . $uID . "&delete_msg=You have deleted a task!");
}
