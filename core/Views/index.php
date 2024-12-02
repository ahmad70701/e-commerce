<?php
require "../UtilitiesFunctions.php"
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Index</title>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Figtree', 'sans-serif'],
                    }
                }
            },
            darkMode: 'class',
        };
        function toggleTheme() {
            const htmlElement = document.documentElement;
            if (htmlElement.classList.contains('dark')) {
                htmlElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                htmlElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });
    </script>
</head>

<body class="dark:bg-gray-700 bg-gray-200 text-black dark:text-white">
    <pre><h1 class="text-3xl font-bold p-3"><?= "NayaPay" ?></h1></pre>
    <button class="m-4 p-2 bg-gray-100 rounded-lg dark:bg-gray-800 " onclick="toggleTheme()">
        Toggle Dark Mode
    </button>
</body>

</html>