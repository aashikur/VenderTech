<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.html'); // Redirect to login page if not logged in
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <header class="flex justify-between items-center p-4 bg-gray-800 text-white">
        <!-- Logo -->
        <div class="text-2xl font-semibold">Vender Tech</div>

        <!-- User Menu -->
        <div class="relative">
            <button class="flex items-center space-x-2 bg-gray-700 p-2 rounded-full">
                <span class="text-white">User</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Logout Dropdown -->
            <div class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg p-2 hidden">
                <a href="logout.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 rounded-lg">Logout</a>
            </div>
        </div>
    </header>

    <script>
        // Show logout menu when user clicks on the user button
        document.querySelector('button').addEventListener('click', function () {
            document.querySelector('div.hidden').classList.toggle('hidden');
        });
    </script>

    <!-- Main Content -->
    <main class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Item List -->
            <?php
            // Array of items for example purposes
            $items = [
                "Item 1", "Item 2", "Item 3", "Item 4", "Item 5",
                "Item 6", "Item 7", "Item 8", "Item 9", "Item 10"
            ];

            foreach ($items as $item) {
                echo "
                <div class='bg-white p-4 rounded-lg shadow-md'>
                    <div class='flex justify-between items-center'>
                        <h3 class='text-xl font-semibold'>$item</h3>
                    </div>
                    <div class='flex items-center space-x-4'>
                        <button class='bg-gray-200 px-3 py-1 rounded-full text-lg'>-</button>
                        <input type='number' value='10' class='text-center w-12 py-1 border border-gray-300 rounded' />
                        <button class='bg-gray-200 px-3 py-1 rounded-full text-lg'>+</button>
                    </div>
                    <button class='mt-4 w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700'>Save</button>
                </div>
                ";
            }
            ?>
        </div>
    </main>

</body>

</html>
