<?php
include("tasktrackerdb.php");
date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d');
$currentTime = date('H:i:s');

if (isset($_GET['userID']) && isset($_GET['taskID'])) {
    $uID = $_GET['userID'];
    $tID = $_GET['taskID'];

    // Fetch the task details from the tasks table
    $stmt = $connection->prepare("SELECT * FROM `tasks` WHERE `UserID` = ? AND `TaskID` = ?");
    $stmt->bind_param("ii", $uID, $tID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc(); // Fetch the result and assign it to $row

    $tName = $row['TaskName']; // Now you can access $row['TaskName']

    // Check if the task already exists in the archives
    $stmt = $connection->prepare("SELECT * FROM `archives` WHERE `UserID` = ? AND `TaskID` = ?");
    $stmt->bind_param("ii", $uID, $tID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {    
        // If the task already exists in the archives, update the existing record
        $stmt = $connection->prepare("UPDATE `archives` SET `CompletionDate` = ?, `CompletionTime` = ?, `is_archived` = 1 WHERE `UserID` = ? AND `TaskID` = ?");
        $stmt->bind_param("ssii", $currentDate, $currentTime, $uID, $tID);
        $stmt->execute();
    } else {
        // If the task does not exist in the archives, insert a new record
        $stmt = $connection->prepare("INSERT INTO `archives` (`TaskID`, `CompletionDate`, `TaskName`, `UserID`, `CompletionTime`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issis", $tID, $currentDate, $tName, $uID, $currentTime);
        $stmt->execute();
    }

    // Update the tasks table to set is_archived to 1
    $stmt = $connection->prepare("UPDATE `tasks` SET `is_archived` = 1 WHERE `UserID` = ? AND `TaskID` = ?");
    $stmt->bind_param("ii", $uID, $tID);
    $stmt->execute();

    header("Location: home.php?id=" . $uID . "&complete_msg=You have completed a task!");
    exit();
}
?>
