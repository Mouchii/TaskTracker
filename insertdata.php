<?php
include("tasktrackerdb.php");

if (isset($_POST['addTask'])) {
    $id = $_POST['id'];
    $tname = $_POST['tName'];
    $tdeadline = $_POST['tDeadline'];
    $ttimedeadline = $_POST['tTimeDeadline'];

    if (
        ($tname == "" || empty($tname))
        && ($tdeadline == "" || empty($tdeadline)) && ($ttimedeadline == "" || empty($ttimedeadline)) 
    ) {
        $errorMessage = "Please fill up all the necessary information!";
        echo "<script>alert('{$errorMessage}');</script>";
    } else {
        $stmt = $connection->prepare("INSERT INTO `tasks` (`TaskName`, `TaskDeadline`, `UserID`, `TaskTimeDeadline`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $tname, $tdeadline, $id, $ttimedeadline);

        if ($stmt->execute()) {
            header("location: home.php?id=" . $id . "&insert_msg= Task added!");
        } else {
            die("Query Failed: " . $stmt->error);
        }
    }
}
