<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demo SEMTEC</title>
    <link rel="shortcut icon" href="{{ asset('img/logo/logo-icon.png') }}">
</head>

<body>

    <x-app-layout>


        <div class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col">


            <div
                class="min-h-screen bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-10 px-4 sm:px-6 lg:px-20">
                <livewire:ejemplo-semtec />
            </div>


        </div>
        </div>
    </x-app-layout>

</body>

</html>