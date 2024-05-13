<?php
include("stuff/head.php");
include("tasktrackerdb.php");
include("stuff/nav.php");

?>



<!-- form validation -->
<script>
function validateForm() {
    var tname = document.getElementById("taskName").value;
    var tDeadline = document.getElementById("tDeadline").value;

    if (tname === "" || tDeadline === "" ) {
        alert("Please fill out all the necessary details.");
        return false;
    }

    var currentDate = new Date();
    var enteredDeadline = new Date(tDeadline);

    if (enteredDeadline < currentDate) {
        alert("Invalid deadline. Please enter a valid deadline for your task.");
        return false;
    }

    return true;

}
</script>

<!-- end of form validation -->

<form method="post" action="insertdata.php" onsubmit="return validateForm()">

    <div class=" space-y-12 border p-10 sm:rounded-[24px] sm:my-10 sm:mx-10 lg:mx-36 lg:my-10 md:p-8 lg:p-10 md:m-10
    shadow-md rounded-[0] md:rounded-[24px] lg:rounded-[24px]">
        <div class=" pb-0">

            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-lg font-semibold leading-7 text-gray-900">Task Details</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Every input should be filled out with an appropriate
                    task details.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-4">
                    <div class="sm:col-span-3">
                        <label for="task-name" class="block text-sm font-medium leading-6 text-gray-900">Task
                            name</label>
                        <div class="mt-2">
                            <input type="text" name="tName" id="taskName" autocomplete="given-name"
                                class="px-5 h-12 block w-9/12 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="task-deadline" class="block text-sm font-medium leading-6 text-gray-900">Set Deadline</label>
                        <div class="mt-2">
                            <input type="date" name="tDeadline" id="tDeadline"
                                class="px-5 h-12 block w-9/12 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    
                </div>


            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-4">
            <a href="home.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" action="home.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>"
                class="border rounded-md px-7 py-1 border-gray-400 text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <input value="Add Task" type="submit" name="addTask"
                class="cursor-pointer rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600" />

        </div>
</form>
