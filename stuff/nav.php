<nav x-data="{ isOpen: false }" class="relative bg-gradient-to-tr from-indigo-500 to-purple-700 drop-shadow-lg shadow-lg py-2">
    <div class="container px-6 py-4 mx-auto md:flex md:justify-between md:items-center">
        <div class="flex items-center justify-between">


            <div class="flex justify-center items-center gap-x-2" onmouseover="playGif()" onmouseout="stopGif()">

                <img class="logo h-10 w-auto" src="stuff/TaskTracker.png">
                <script>
                    function playGif() {
                        document.querySelector('.logo').src = 'stuff/TaskTracker.gif';
                    }

                    function stopGif() {
                        document.querySelector('.logo').src = 'stuff/TaskTracker.png';
                    }
                </script>
                <a href="home.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" class="text-white text-3xl ">
                    <span class="font-bold">Task Tracker</span>
                </a>
            </div>


            <!-- Mobile menu button -->
            <div class="flex md:hidden">
                <button x-cloak @click="isOpen = !isOpen" type="button" class="text-white hover:text-gray-600 focus:outline-none focus:text-gray-600 " aria-label="toggle menu">
                    <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                    </svg>

                    <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']" class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-blue-600 md:mt-0 md:p-0 md:top-0 md:relative md:bg-transparent md:w-auto md:opacity-100 md:translate-x-0 md:flex md:items-center">
            <div class="flex flex-col md:flex-row md:mx-6">
                <a class="lg:px-[15px] lg:py-[5px] rounded-md my-2 text-white transition-all duration-300 transform hover:-translate-y-1 hover:scale-110 hover:shadow-lg md:mx-4 md:my-0" href="home.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">Home</a>
                <a class="lg:px-[15px] lg:py-[5px] rounded-md my-2 text-white transition-all duration-300 transform hover:-translate-y-1 hover:scale-110 hover:shadow-lg md:mx-4 md:my-0" href="archiveTaskPage.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">Archives</a>
                <a class="lg:px-[15px] lg:py-[5px] rounded-md my-2 text-white transition-all duration-300 transform hover:-translate-y-1 hover:scale-110 hover:shadow-lg md:mx-4 md:my-0 cursor-pointer" onclick="confirmLogOut()">Log Out</a>
                <script>
                    function confirmLogOut() {

                        if (confirm("Are you sure you want to log out?")) {
                            window.location.href = 'index.php'
                            return true;
                        } else {
                            return false;
                        }
                    }
                </script>
            </div>


        </div>


    </div>
</nav>