<?php
include("stuff/head.php");
include("tasktrackerdb.php");
include("stuff/nav.php");

if (isset($_GET['userID']) && isset($_GET['taskID'])) {
    $uID = $_GET['userID'];
    $tID = $_GET['taskID'];
    $query = "SELECT * FROM `tasks` WHERE `UserID` = '$uID' AND `TaskID` = '$tID'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        $row = mysqli_fetch_assoc($result);
    }
}

if (isset($_POST['updateTask'])) {
    $uID = $_GET['userID'];
    $tID = $_GET['taskID'];
    $tname = $_POST['tName'];
    $tdeadline = $_POST['tDeadline'];

    $query = "UPDATE `tasks` SET `TaskName` = '$tname', `TaskDeadline` = '$tdeadline' WHERE `UserID` = '$uID' AND `TaskID` = '$tID'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        header("Location: home.php?id=" . $uID . "&update_msg=You have successfully updated a task!");
        exit();
    }
}
?>



<!-- form validation -->
<script>
function validateForm() {
    var tname = document.getElementById("task-Name").value;
    var tDeadline = document.getElementById("task-Deadline").value;
    

    if (tname === "" || tDeadline === "" ) {
        alert("Please fill out all the necessary details.");
        return false;
    }

    var currentDate = new Date();
    var enteredDeadline = new Date(tDeadline);

    if (enteredDeadline <= currentDate) {
        alert("Invalid deadline. Please enter a valid deadline for your task.");
        return false;
    }

    return true;

}
</script>

<!-- end of form validation -->

<form action="editTaskPage.php?userID=<?= $uID; ?>&taskID=<?= $row['TaskID']; ?>" method="post" onsubmit="return validateForm()">
    <div class="space-y-12 border p-10 sm:rounded-[24px] sm:my-10 sm:mx-10 lg:mx-36 lg:my-10 md:p-8 lg:p-10 md:m-10 shadow-md rounded-[0] md:rounded-[24px] lg:rounded-[24px]">
        <div class=" pb-0">

            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-lg font-semibold leading-7 text-gray-900">Edit Task Details</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">You can edit, delete, and update the task details
                    in this section.</p>

                <div class="sm:col-span-4">
                    <label for="task-ID" class="block text-sm font-medium leading-6 text-gray-900">Task
                            ID</label>
                    <div class="mt-2">
                        <input disabled type="text" name="TaskID" id="TaskID" autocomplete="TaskID" value="<?= $row['TaskID'] ?>"
                                class="px-5 block w-40 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6">
                    </div>
                </div>    

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-4">
                    <div class="sm:col-span-3">
                        <label for="task-Name" class="block text-sm font-medium leading-6 text-gray-900">Task
                            name</label>
                        <div class="mt-2">
                            <input type="text" name="tName" id="task-Name" autocomplete="given-name" value="<?= $row['TaskName'] ?>"
                                class="px-5 h-12 block w-9/12 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="task-Deadline" class="block text-sm font-medium leading-6 text-gray-900">Set Deadline</label>
                        <div class="mt-2">
                            <input type="date" name="tDeadline" id="task-Deadline" value="<?= $row['TaskDeadline'] ?>"
                                class="px-5 h-12 block w-9/12 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    
                </div>


            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-4">
            <a href="home.php?id=<?php echo isset($_GET['userID']) ? $_GET['userID'] : ''; ?>" action="home.php?id=<?php echo isset($_GET['userID']) ? $_GET['userID'] : ''; ?>"
                class="border rounded-md px-7 py-1 border-gray-400 text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <a href="#" onclick="confirmDelete(<?= $uID; ?>, <?= $tID; ?>)" class="border rounded-md px-7 py-1 border-red-500 bg-red-500 text-sm font-semibold leading-6 text-white">Delete Task</a>
            
            <input value="Update Task" type="submit" name="updateTask" class="cursor-pointer rounded-md bg-purple-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600" />
        </div>

        <script>
            function confirmDelete(userID, taskID) {
                if (confirm("Are you sure you want to delete this task?")) {
                    window.location.href = 'deleteTask.php?userID=' + userID + '&taskID=' + taskID;
                }
            }
        </script>
       
</form>
