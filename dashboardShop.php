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
    <header class="flex justify-between items-center py-6 px-48 bg-black text-white border-b-2 border-gray-700">
        <!-- Logo -->
        <div ><span class="cursor-pointer text-2xl font-semibold">Vender<span class="underline">Tech</span></span></div>

        <!-- User Menu -->
        <div class="relative">
            <button id="userMenuBtn" class="flex items-center space-x-2 bg-gray-700 p-2 rounded-full">
            <span class="pl-2 text-white"> Profile</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Logout Dropdown -->
            <div id="logoutMenu" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg p-2 hidden">
                <a href="logout.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 rounded-lg">Logout</a>
            </div>
        </div>
    </header>

<!-- Hero Section -->
<section class="bg-blue-600 text-white py-16">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <!-- Left Section -->
        <div class="w-1/2">
            <h1 class="text-4xl font-semibold">Shop: <span class="font-bold">ALL SHOP</span></h1>
            <p class="mt-2 text-xl">Search your items here</p>
        </div>

        <!-- Search Section -->
        <div class="w-1/2 pl-10">
            <div class="mb-4">
                <input type="text" id="searchInput" placeholder="Search items..." class="text-black w-full px-4 py-3 border border-gray-300 rounded-lg text-md">
            </div>
            <div>
                <a href="dashboard.php" class="underline text-white font-semibold hover:underline">Go back MY SHOP</a>
            </div>
        </div>
    </div>
</section>
    <!-- Main Content -->
    <main style="min-height:60vh" class="p-6">
        <div style="width:80%; padding: 0 20px;" class="mr-auto ml-auto grid grid-cols-1 gap-6" id="itemList">
            <!-- Item List -->
            <?php
            // Array of items with meaningful names and their corresponding quantities and labels
            $items = [
                ["name" => "Corsair 64GB USB Pendrive", "quantity" => 10, "label" => "Shop A"],
                ["name" => "Asus 27-inch 144Hz Monitor", "quantity" => 15, "label" => "Shop C"],
                ["name" => "Intel Core i3 Processor", "quantity" => 8, "label" => "Shop E"],
                ["name" => "HP Laptop with 16GB RAM", "quantity" => 20, "label" => "Shop G"],
                ["name" => "Logitech Wireless Keyboard", "quantity" => 12, "label" => "Shop I"],
                ["name" => "Razer Gaming Mouse", "quantity" => 14, "label" => "Shop K"],
                ["name" => "Seagate 2TB External Hard Drive", "quantity" => 18, "label" => "Shop M"],
                ["name" => "Sony WH-1000XM5 Headphones", "quantity" => 22, "label" => "Shop O"],
                ["name" => "NVIDIA GTX 3060 Graphics Card", "quantity" => 6, "label" => "Shop Q"],
                ["name" => "Ergonomic Office Chair", "quantity" => 25, "label" => "Shop S"]
            ];

            foreach ($items as $item) {
                echo "
                <div class='item flex justify-between gap-6 bg-white p-4 rounded-lg shadow-md'>
                    <div>
                        <h3 class='text-xl font-semibold item-name'>{$item['name']}</h3>
                    </div>
                    <div class='flex gap-6 items-center'>
                        <!-- Quantity -->
                        <span class='text-gray-800 font-medium'>Quantity: {$item['quantity']}</span>
                        <!-- Label -->
                        <span class='bg-gray-200 text-gray-800 font-bold px-3 py-1 rounded-full'>{$item['label']}</span>
                    </div>
                </div>
                ";
            }
            ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-between items-center">
                <!-- Footer Logo -->
                <div class="mb-4 md:mb-0">
                    <a href="#" class="text-2xl font-semibold">Vender Tech</a>
                </div>

                <!-- Footer Links -->
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-300 hover:text-white">About</a>
                    <a href="#" class="text-gray-300 hover:text-white">Services</a>
                    <a href="#" class="text-gray-300 hover:text-white">Contact</a>
                    <a href="#" class="text-gray-300 hover:text-white">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Show logout menu when user clicks on the user button
            const userMenuBtn = document.getElementById('userMenuBtn');
            const logoutMenu = document.getElementById('logoutMenu');
            userMenuBtn.addEventListener('click', () => {
                logoutMenu.classList.toggle('hidden');
            });

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const items = document.querySelectorAll('.item');

            searchInput.addEventListener('keyup', function () {
                const filter = searchInput.value.toLowerCase().trim();
                items.forEach(item => {
                    const itemName = item.querySelector('.item-name').textContent.toLowerCase();
                    if (itemName.includes(filter)) {
                        item.style.display = 'flex'; // Show item if it matches the search
                    } else {
                        item.style.display = 'none'; // Hide item if it doesn't match
                    }
                });
            });
        });
    </script>

</body>

</html>
