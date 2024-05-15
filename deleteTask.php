<?php
include("tasktrackerdb.php");

if (isset($_GET['userID']) && isset($_GET['taskID'])) {
    $uID = $_GET['userID'];
    $tID = $_GET['taskID'];

    // Prepare the DELETE statement for the archives table
    $stmt = $connection->prepare("DELETE FROM `archives` WHERE `UserID` = ? AND `TaskID` = ?");
    $stmt->bind_param("ii", $uID, $tID); // "ii" indicates the data types are integers

    // Execute the DELETE statement
    if ($stmt->execute()) {
        // Prepare the DELETE statement for the tasks table
        $stmt = $connection->prepare("DELETE FROM `tasks` WHERE `UserID` = ? AND `TaskID` = ?");
        $stmt->bind_param("ii", $uID, $tID);

        // Execute the DELETE statement
        if ($stmt->execute()) {
            header("Location: home.php?id=" . $uID . "&delete_msg=You have deleted a task!");
        } else {
            die("Failed to delete task: " . $stmt->error);
        }
    } else {
        die("Failed to delete archive: " . $stmt->error);
    }
}
