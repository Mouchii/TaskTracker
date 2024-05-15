<?php
include("tasktrackerdb.php");
$currentDate = date('Y-m-d');
echo $currentDate;

if (isset($_GET['userID']) && isset($_GET['taskID'])) {
    $uID = $_GET['userID'];
    $tID = $_GET['taskID'];

    $stmt = $connection->prepare("SELECT * FROM `tasks` WHERE `UserID` = ? AND `TaskID` = ?");
    $stmt->bind_param("ii", $uID, $tID);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("query failed");
    } else {
        while ($row = $result->fetch_assoc()) {
            $tName = $row['TaskName'];
        }

        if (isset($_GET['userID']) && isset($_GET['taskID'])) {
            $stmt = $connection->prepare("INSERT INTO `archives` (`TaskID`, `CompletionDate`, `TaskName`, `UserID`) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("issi", $tID, $currentDate, $tName, $uID);
            $stmt->execute();
        }
    }

    if (isset($_GET['userID']) && isset($_GET['taskID'])) {
        $uID = $_GET['userID'];
        $tID = $_GET['taskID'];

        $stmt = $connection->prepare("UPDATE `tasks` SET `is_archived` = 1 WHERE `UserID` = ? AND `TaskID` = ?");
        $stmt->bind_param("ii", $uID, $tID);
        $stmt->execute();

        header("Location: home.php?id=" . $uID . "&complete_msg=You have completed a task!");
        exit();
    }
}
?>
