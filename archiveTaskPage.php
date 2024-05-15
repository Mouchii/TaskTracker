<?php
ob_start();
include("stuff/head.php");
include("stuff/nav.php");
include("tasktrackerdb.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tasks WHERE `UserID` = '$id'";
    $result = mysqli_query($connection, $query);
}
?>

<?php
if (isset($_GET['restore_msg'])) {
?>

    <div class="w-full text-white bg-purple-400">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
            <div class="flex">
                <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                    </path>
                </svg>

                <p class="mx-3">
                    <?= $_GET['restore_msg'] ?>
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
<section class="container mx-auto mt-[40px]">
    <div class="border p-6 mx-5 md:p-8 shadow-md rounded-[24px] bg-white">

        <div class="flex items-center justify-between gap-x-3">
            <div>
                <h2 class="text-2xl font-medium text-gray-800">Task Archives</h2>
            </div>
        </div>

        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8 px-6">
                    <div class="overflow-hidden border border-gray-200  md:rounded-lg ">
                        <table class="min-w-full divide-y divide-gray-200 ">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 ">
                                        Completion</th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 ">
                                        Task ID</th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Task Name</th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Date Completed</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200  ">
                                <?php

                                $page = isset($_GET['page']) ? max(1, $_GET['page']) : 1;
                                $rowsPerPage = 6; 

                                $query = "SELECT * FROM `archives` WHERE `is_archived` = 1 AND `UserID` = '$id' LIMIT " . ($page - 1) * $rowsPerPage . ", $rowsPerPage";
                                $result = mysqli_query($connection, $query);

                                if (!$result) {
                                    die("query failed" . mysqli_error());
                                } else {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td class="px-4 py-4 text-sm text-gray-500  whitespace-nowrap">
                                                <div class="flex justify-center mb-0">
                                                <input checked id="checked-checkbox" type="checkbox" value="" onclick="confirmRestore(<?= $id; ?>, <?= $row['TaskID']; ?>)" class="w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <script>
                                                        function confirmRestore(userID, taskID) {
                                                            event.preventDefault();
                                                            if (confirm("Are you sure you want to restore this task?")) {
                                                                window.location.href = 'restoreTask.php?userID=' + userID + '&taskID=' + taskID;
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
                                                <?= $row['TaskName']; ?>
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-500  whitespace-nowrap">
                                                <?= $row['CompletionDate']; ?> || <?= date("g:i A", strtotime($row['CompletionTime'])); ?>
                                            </td>

                                        </tr>
                                <?php
                                    }
                                }
                                $totalRowsQuery = "SELECT COUNT(*) as total FROM `archives`";
                                $totalResult = mysqli_query($connection, $totalRowsQuery);
                                $totalRows = mysqli_fetch_assoc($totalResult)['total'];
                                $totalPages = ceil($totalRows / $rowsPerPage);
                                ?>

                            </tbody>
                        </table>

                        <?php
                        if (mysqli_num_rows($result) <= 0) {
                        ?>
                            <div class="flex items-center p-20 text-center bg-gray-50">
                                <div class="flex flex-col w-full max-w-sm px-4 mx-auto">
                                    <div class="p-3 mx-auto text-blue-500 bg-blue-100 rounded-full">
                                    <img src="stuff/SadVaultBoy.png" class="w-40 h-40" alt="Close" />
                                    </div>
                                    <h1 class="mt-3 text-lg text-gray-800">No tasks completed</h1>
                                    <p class="mt-2 text-gray-500">You haven't completed any tasks yet</p>

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
            echo '<a href="?id=' . $id . '&page=' . $i . '" class="px-2 py-1 text-sm transition-all duration-300 transform hover:-translate-y-1 hover:scale-110' . ($i == $page ? 'text-purple-500' : 'text-gray-500') . ' rounded-md ' . ($i == $page ? 'bg-purple-100/60' : 'hover:bg-gray-100') . '">';
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
</body>

<?php include ("stuff/foot.php");