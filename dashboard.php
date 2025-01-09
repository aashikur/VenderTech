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
    <header class="flex justify-between items-center py-4 px-48 bg-gray-800 text-white">
        <!-- Logo -->
        <div ><span class="cursor-pointer text-2xl font-semibold">Vender<span class="underline">Tech</span></span></div>
        <!-- User Menu -->
        <div class="relative">
            <button class="flex items-center space-x-2 bg-gray-700 p-2 rounded-full" id="userMenuButton">
                <span class="pl-2 text-white"> Profile</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l7 7-7 7"></path>
                </svg>
            </button>
            <div class="absolute right-0 mt-2 w-40 bg-white border rounded-md shadow-lg hidden" id="userMenu">
                <button class="block w-full px-4 py-2 text-left text-gray-800" id="logoutButton">Logout</button>
            </div>
        </div>
    </header>
<!-- Hero Section -->
<section class="bg-blue-600 text-white py-16">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <!-- Left Section -->
        <div class="w-1/2">
            <h1 class="text-4xl font-semibold">Your Shop: <span class="font-bold">SHOP A</span></h1>
            <p class="mt-2 text-xl">Search your items here</p>
        </div>

        <!-- Search Section -->
        <div class="w-1/2 pl-10">
            <div class="mb-4">
                <input type="text" id="searchInput" placeholder="Search items..." class="text-black w-full px-4 py-3 border border-gray-300 rounded-lg text-md">
            </div>
            <div>
                <a href="dashboardShop.php" class="underline text-white font-semibold hover:underline">Search from other shops ??</a>
            </div>
        </div>
    </div>
</section>

    <!-- Main Content -->
    <main style="min-height:60vh" class="p-6">
        <div style="width:80%; padding: 0 20px;" class="mr-auto ml-auto grid grid-cols-1 gap-6" id="itemList">
            <!-- Item List -->
            <?php
            // Array of items with meaningful names
            $items = [
                ["name" => "Pendrive 64GB Corsair"],
                ["name" => "Asus Monitor 27-inch"],
                ["name" => "Processor Core i3"],
                ["name" => "HP Laptop 16GB RAM"],
                ["name" => "Wireless Keyboard Logitech"],
                ["name" => "Gaming Mouse Razer"],
                ["name" => "External Hard Drive 2TB"],
                ["name" => "Headphones Sony WH-1000XM5"],
                ["name" => "Graphics Card GTX 3060"],
                ["name" => "Office Chair Ergonomic"]
            ];

            foreach ($items as $item) {
                echo "
                <div class='item flex justify-between gap-6 bg-white p-4 rounded-lg shadow-md'>
                    <div>
                        <h3 class='text-xl font-semibold item-name'>{$item['name']}</h3>
                    </div>
                    <div class='flex gap-6 items-center'>
                        <!-- Quantity Controls -->
                        <div class='flex items-center space-x-4'>
                            <button class='decrement bg-gray-200 px-3 py-1 rounded-full text-lg'>-</button>
                            <input type='number' value='10' min='1' class='quantity text-center w-12 py-1 border border-gray-300 rounded' />
                            <button class='increment bg-gray-200 px-3 py-1 rounded-full text-lg'>+</button>
                        </div>
                        <button class='bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700'>Save</button>
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
            <div class="text-center">© 2025 Vender Tech. All rights reserved.</div>
        </div>
    </footer>

    <script>
        // Show logout menu when user clicks on the user button
        document.getElementById('userMenuButton').addEventListener('click', function () {
            document.getElementById('userMenu').classList.toggle('hidden');
        });

        // Logout functionality
        document.getElementById('logoutButton').addEventListener('click', function () {
            window.location.href = 'logout.php'; // Redirect to logout page
        });

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const items = document.querySelectorAll('.item');

        searchInput.addEventListener('keyup', function () {
            const filter = searchInput.value.toLowerCase();
            items.forEach(item => {
                const itemName = item.querySelector('.item-name').textContent.toLowerCase();
                if (itemName.includes(filter)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Quantity increment and decrement functionality
        document.querySelectorAll('.increment').forEach((btn, index) => {
            btn.addEventListener('click', function () {
                const quantityInput = document.querySelectorAll('.quantity')[index];
                quantityInput.value = parseInt(quantityInput.value) + 1;
            });
        });

        document.querySelectorAll('.decrement').forEach((btn, index) => {
            btn.addEventListener('click', function () {
                const quantityInput = document.querySelectorAll('.quantity')[index];
                if (quantityInput.value > 1) {  // Ensures the value doesn't go below 1
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                }
            });
        });
    </script>

</body>

</html>
