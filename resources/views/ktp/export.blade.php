@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-blue-200 to-purple-300 flex items-center justify-center">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-8">
                <h2 class="text-4xl font-bold text-center text-gray-800 mb-6">Export Data KTP</h2>
                <p class="text-lg text-gray-600 text-center mb-8">
                    Pilih format file yang ingin Anda unduh untuk data KTP Anda.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-blue-100 p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-2xl font-semibold text-blue-600 mb-4">CSV</h3>
                        <p class="text-gray-500 mb-4">Ekspor data dalam format CSV untuk penggunaan lebih lanjut.</p>
                        <a href="{{ url('export/csv') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-200">
                            Export CSV
                        </a>
                    </div>

                    <div class="bg-pink-100 p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-2xl font-semibold text-pink-600 mb-4">PDF</h3>
                        <p class="text-gray-500 mb-4">Ekspor data dalam format PDF untuk dokumen resmi.</p>
                        <a href="{{ url('export/pdf') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-pink-600 text-white font-semibold rounded-md hover:bg-pink-700 transition duration-200">
                            Export PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
