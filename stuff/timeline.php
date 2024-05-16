<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $currentDate = date("Y-m-d");

    // Prepare the SQL statement
    $stmt = $connection->prepare("SELECT TaskName, TaskDeadline, TaskTimeDeadline FROM tasks WHERE TaskDeadline >= ? AND is_archived = 0 ORDER BY TaskDeadline ASC, TaskTimeDeadline ASC");
    $stmt->bind_param("s", $currentDate); // "s" indicates the data type is a string

    // Execute the SQL statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch all rows and display them
    while ($row = $result->fetch_assoc()) {

?>
<!-- Timeline -->

<div>
    <!-- Item -->
    <div class="flex gap-x-3">
        <!-- Left Content -->
        <div class="w-16 text-end">
            <span class="text-xs text-gray-500"><?= $row['TaskDeadline']; ?></span>
        </div>
        <!-- End Left Content -->

        <!-- Icon -->
        <div class="relative last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200">
        <div class="relative z-10 size-7 flex justify-center items-center">
                <div class="size-2 rounded-full bg-gray-400"></div>
            </div>
        </div>
        <!-- End Icon -->

        <!-- Right Content -->
        <div class="grow pt-0.5 pb-8">
            <h3 class="flex gap-x-1.5 font-semibold text-gray-800">
                <svg class="flex-shrink-0 size-4 mt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" x2="8" y1="13" y2="13"></line>
                    <line x1="16" x2="8" y1="17" y2="17"></line>
                    <line x1="10" x2="8" y1="9" y2="9"></line>
                </svg>
                <?= nl2br(chunk_split($row['TaskName'], 75, "\n")) ?>
            </h3>
            <p class="mt-1 text-sm text-gray-600">
                Due: <?= date("g:i A", strtotime($row['TaskTimeDeadline'])); ?>
            </p>
        </div>
        <!-- End Right Content -->
    </div>
    <!-- End Item -->

</div>
<!-- End Timeline -->
<?php
    }
}

?>
