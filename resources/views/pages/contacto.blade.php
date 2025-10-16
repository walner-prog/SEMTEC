<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contacto</title>
</head>

<body>

    <x-app-layout>


        <div class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col">



            <main class="flex-grow bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 
                    dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen">

                <div class="max-w-4xl mx-auto py-12 px-6  ">

                    <h1 class="text-4xl font-extrabold text-red-700 dark:text-red-400 mb-8 flex items-center gap-3">
                        <i class="fa-solid fa-envelope text-4xl animate-bounce"></i>
                        📩 Contacto
                    </h1>

                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg mb-8">
                        Si tienes preguntas, comentarios o sugerencias, no dudes en escribirnos. ¡Queremos saber de ti!
                        💌
                    </p>

                    <form class="space-y-6">
                        <div class="flex items-center gap-4 bg-white dark:bg-gray-700 rounded-xl shadow-md p-4">
                            <i class="fa-solid fa-user text-red-600 dark:text-red-400 text-2xl"></i>
                            <input type="text" placeholder="Nombre"
                                class="w-full border-none focus:ring-0 focus:outline-none text-gray-800 dark:text-gray-100 bg-transparent">
                        </div>

                        <div class="flex items-center gap-4 bg-white dark:bg-gray-700 rounded-xl shadow-md p-4">
                            <i class="fa-solid fa-envelope text-red-600 dark:text-red-400 text-2xl"></i>
                            <input type="email" placeholder="Correo"
                                class="w-full border-none focus:ring-0 focus:outline-none text-gray-800 dark:text-gray-100 bg-transparent">
                        </div>

                        <div class="flex items-start gap-4 bg-white dark:bg-gray-700 rounded-xl shadow-md p-4">
                            <i class="fa-solid fa-comment-dots text-red-600 dark:text-red-400 text-2xl mt-2"></i>
                            <textarea rows="4" placeholder="Mensaje"
                                class="w-full border-none focus:ring-0 focus:outline-none text-gray-800 dark:text-gray-100 bg-transparent resize-none"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full flex items-center justify-center gap-3 px-6 py-4 bg-red-600 hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 text-white font-bold rounded-2xl shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                            <i class="fa-solid fa-paper-plane text-xl"></i> Enviar
                        </button>
                    </form>
                </div>


            </main>




        </div>

    </x-app-layout>

</body>

</html>