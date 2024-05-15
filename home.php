<?php
include("stuff/head.php");
include("tasktrackerdb.php");
include("stuff/nav.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tasks WHERE `UserID` = '$id'";
    $result = mysqli_query($connection, $query);
}
?>



<?php
if (isset($_GET['insert_msg']) || isset($_GET['update_msg'])) {
?>

    <div class="w-full text-white bg-purple-500 ">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
            <div class="flex">
                <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
                    </path>
                </svg>

                <?php
                if (isset($_GET['insert_msg'])) {
                ?>
                    <p class="mx-3">
                        <?php echo $_GET['insert_msg'] ?>
                    </p>

                <?php
                } else if (isset($_GET['update_msg'])) {
                ?>
                    <p class="mx-3">
                        <?php echo $_GET['update_msg'] ?>
                    </p>
                <?php
                } else {
                }
                ?>

            </div>

            <button id="closeButton" class="p-1 transition-colors duration-300 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        document.getElementById("closeButton").addEventListener("click", function() {
            var parentDiv = this.closest('.w-full');
            parentDiv.style.display = "none";
        });
    </script>


<?php
}
?>

<?php
if (isset($_GET['complete_msg'])) {
?>

    <div class="w-full text-white bg-emerald-500">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
            <div class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="rgba(255,255,255,1)" class="h-5 w-5">
                    <path fill="none" d="M0 0h24v24H0z"></path>
                    <path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM9 11V17H11V11H9ZM13 11V17H15V11H13ZM9 4V6H15V4H9Z">
                    </path>
                </svg>

                <p class="mx-3">
                    <?= $_GET['complete_msg'] ?>
                </p>
            </div>

            <button id="closeButton" class="p-1 transition-colors duration-300 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        document.getElementById("closeButton").addEventListener("click", function() {
            var parentDiv = this.closest('.w-full');
            parentDiv.style.display = "none";
        });
    </script>
<?php
}
?>

<?php
if (isset($_GET['delete_msg'])) {
?>

    <div class="w-full text-white bg-red-500">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
            <div class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="rgba(255,255,255,1)" class="h-5 w-5">
                    <path fill="none" d="M0 0h24v24H0z"></path>
                    <path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM9 11V17H11V11H9ZM13 11V17H15V11H13ZM9 4V6H15V4H9Z">
                    </path>
                </svg>

                <p class="mx-3">
                    <?= $_GET['delete_msg'] ?>
                </p>
            </div>

            <button id="closeButton" class="p-1 transition-colors duration-300 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        document.getElementById("closeButton").addEventListener("click", function() {
            var parentDiv = this.closest('.w-full');
            parentDiv.style.display = "none";
        });
    </script>
<?php
}
?>

<body class="bg-gradient-to-r from-gray-50 to-blue-100">
<section class="container mx-auto mt-[40px] ">


    <div class="border p-6 mx-5 md:p-8 drop-shadow-xl rounded-[24px] bg-white">
        <div class="flex items-center justify-between gap-x-3">

            <div>
                <div class="flex items-center gap-x-3">
                    <h2 class="text-2xl font-medium text-gray-800">Tasks </h2>

                </div>



            </div>

            <a href="addTaskPage.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" class="flex items-center px-5 py-2 text-sm text-white capitalize transition-colors duration-200 bg-purple-700 border rounded-md gap-x-2 hover:bg-purple-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>
                    Add Task
                </span>
            </a>


        </div>

        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8 px-6">
                    <div class="overflow-hidden border border-gray-200  md:rounded-lg ">
                        <table class="min-w-full divide-y divide-gray-200 ">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="text-sm font-normal text-center rtl:text-right text-gray-500 ">
                                        Completion</th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 ">
                                        ID</th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Name</th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Deadline</th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 ">
                                        Modify</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200  ">
                                <?php
                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $rowsPerPage = 6;

                                $query = "SELECT * FROM `tasks` WHERE `is_archived` = 0 AND `UserID` = '$id' LIMIT " . ($page - 1) * $rowsPerPage . ", $rowsPerPage";
                                $result = mysqli_query($connection, $query);

                                if (!$result) {
                                    die("query failed" . mysqli_error());
                                } else {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td class="px-4 py-4 text-sm text-gray-500  whitespace-nowrap">
                                                <div class="flex justify-center mb-0">
                                                    <input id="default-checkbox" type="checkbox" value="" onclick="confirmArchive(<?= $id; ?>, <?= $row['TaskID']; ?>)" class="w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                                                    <script>
                                                        function confirmArchive(userID, taskID) {
                                                            event.preventDefault();
                                                            if (confirm("Are you sure you have completed this task?")) {
                                                                window.location.href = 'archiveTask.php?userID=' + userID + '&taskID=' + taskID;
                                                                event.target.checked = true;
                                                            } else {
                                                                event.target.checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 flex justify-center text-sm text-gray-500  whitespace-nowrap">
                                                <?= $row['TaskID']; ?>
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-500  whitespace-nowrap">
                                                <?= $row['TaskName'] ?>
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-500  whitespace-nowrap">
                                                <?= $row['TaskDeadline']; ?>
                                            </td>
                                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                <div class="flex justify-center gap-x-6 ">
                                                <a href="editTaskPage.php?userID=<?= $id; ?>&taskID=<?= $row['TaskID']; ?>" class="flex flex-row gap-x-3 text-purple-700 transition-all duration-200 hover:text-indigo-500 focus:outline-none transform hover:-translate-y-1 hover:scale-110">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>
                                                        <span>
                                                            Edit Task
                                                        </span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }

                                $totalRowsQuery = "SELECT COUNT(*) as total FROM `tasks`";
                                $totalResult = mysqli_query($connection, $totalRowsQuery);
                                $totalRows = mysqli_fetch_assoc($totalResult)['total'];
                                $totalPages = ceil($totalRows / $rowsPerPage);

                                ?>

                            </tbody>
                        </table>
                        <?php
                        if (mysqli_num_rows($result) <= 0) {
                            // echo mysqli_num_rows($result);
                        ?>
                            <div class="flex items-center p-20 text-center bg-gray-50">
                                <div class="flex flex-col w-full max-w-sm px-4 mx-auto">
                                    <div class="p-3 mx-auto text-blue-500 bg-blue-100 rounded-full">
                                    <img src="stuff/VaultBoy.png" class="w-40 h-40" alt="Close" />
                                    </div>
                                    <h1 class="mt-3 text-lg text-gray-800">No tasks found</h1>
                                    <p class="mt-2 text-gray-500">You are all out of tasks!</p>

                                </div>
                            </div>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- PAGINATION DIV -->

        <?php
        $id = $_GET['id'];

        echo '<div class="flex items-center justify-between mt-6">';
        echo '<a href="?id=' . $id . '&page=' . max($page - 1, 1) . '" class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100">';
         echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">';
                   echo '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />';
                echo '</svg>';
               echo '<span>previous</span>';
        echo '</a>';

        echo '<div class="items-center hidden lg:flex gap-x-3">';
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="?id=' . $id . '&page=' . $i . '" class="px-2 py-1 text-sm transition-all duration-300 transform hover:-translate-y-1 hover:scale-110' . ($i == $page ? 'text-purple-700' : 'text-gray-500') . ' rounded-md ' . ($i == $page ? 'bg-purple-700/15' : 'hover:bg-gray-100') . '">';
            echo $i;
            echo '</a>';
        }
        echo '</div>';

        echo '<a href="?id=' . $id . '&page=' . min($page + 1, $totalPages) . '" class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100">';
        echo '<span>Next</span>';
                echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>';
        echo '</a>';
        echo '</div>';
        ?>

        <!-- END OF PAGINATION DIV -->


    </div>

</section>


<?php
if (isset($_GET['message'])) {
    echo "<h6>" . $_GET['message'] . "</h6>";
}
?>

</body>