<x-app-layout>
    @section('content')
    <div class="min-h-screen bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 flex items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-800 rounded-lg overflow-hidden shadow-xl transform transition duration-500 hover:scale-105 sm:rounded-lg">
                <div class="p-8 bg-white dark:bg-gray-900 border-b border-gray-300 dark:border-gray-800 text-center">
                    <!-- Judul dengan Efek Animasi -->
                    <h1 class="text-4xl font-extrabold text-blue-700 dark:text-pink-400 mb-6 animate-pulse">
                         Selamat Datang! 
                    </h1>
                    
                    <!-- Paragraf Utama -->
                    <p class="text-xl text-gray-800 dark:text-gray-300 font-semibold mb-4">
                        Anda telah berhasil login!
                    </p>
                    
                    <!-- Role dengan Font Berbeda -->
                    <p class="text-lg text-gray-500 dark:text-gray-400 mt-4">
                        Login sebagai: 
                        <span class="font-bold underline text-green-600 dark:text-green-400">
                            {{ auth()->user()->role }}
                        </span>
                    </p>

                    <!-- Pesan Tambahan dengan Efek Hover -->
                    <p class="mt-6 text-sm text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition duration-300">
                        Semoga harimu menyenangkan!
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
