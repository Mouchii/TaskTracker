<?php
include("stuff/head.php");
include("tasktrackerdb.php");
if (isset($_GET['userID']) && isset($_GET['taskID'])) {
    $uID = $_GET['userID'];
    $tID = $_GET['taskID'];

    $stmt = $connection->prepare("SELECT * FROM `archives` WHERE `is_archived` = 1 AND `UserID` = ? AND `TaskID` = ?");
    $stmt->bind_param("ii", $uID, $tID);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("query failed");
    } else {
        while ($row = $result->fetch_assoc()) {
            $tName = $row['TaskName'];
            $tDeadline = $row['CompletionDate'];
        }

        if (isset($_GET['userID']) && isset($_GET['taskID'])) {
            $stmt = $connection->prepare("UPDATE `tasks` SET `is_archived` = 0 WHERE `UserID` = ? AND `TaskID` = ?");
            $stmt->bind_param("ii", $uID, $tID);
            $stmt->execute();
        }

        if (isset($_GET['userID']) && isset($_GET['taskID'])) {
            $uID = $_GET['userID'];
            $tID = $_GET['taskID'];

            $stmt = $connection->prepare("UPDATE `archives` SET `is_archived` = 0 WHERE `UserID` = ? AND `TaskID` = ?");
            $stmt->bind_param("ii", $uID, $tID);
            $stmt->execute();

            header("Location: archiveTaskPage.php?id=" . $uID . "&restore_msg=You have restored a task!");
            exit();
        }

        ob_end_flush();
    }
}

// if (isset($_GET['restore_msg'])) {
//     echo "<h6>" . $_GET['restore_msg'] . "</h6>";
// }

include("stuff/foot.php");
?>
