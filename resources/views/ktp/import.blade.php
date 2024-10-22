@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-blue-200 to-purple-300 flex items-center justify-center">
    <div class="max-w-7xl mx-auto p-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden p-10">
            <div class="p-6">
                <h2 class="text-4xl font-bold text-center text-gray-800 mb-6">Import Data KTP</h2>

                <p class="text-lg text-gray-600 text-center mb-8">
                    Upload file CSV untuk mengimpor data KTP ke dalam sistem.
                </p>

                <!-- Div Notifikasi -->
                <div id="message" class="hidden mb-4 font-semibold"></div>

                <form id="importCsvForm" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col md:flex-row md:items-center">
                        <div class="flex-1 mb-4 md:mb-0">
                            <input type="file" name="file" accept=".csv" required
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        </div>
                        <div class="md:ml-4"> <!-- Tambahkan margin kiri pada tombol -->
                            <button type="submit"
                                class="inline-flex items-center justify-center px-2 py-1 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition duration-200">
                                Import CSV
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    document.getElementById('importCsvForm').addEventListener('submit', async function(e) {
        e.preventDefault(); // Cegah refresh halaman

        const form = e.target;
        const formData = new FormData(form);

        try {
            const response = await axios.post(`{{ route('import.csv') }}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            showMessage(response.data.message, 'success');
        } catch (error) {
            console.error(error);
            const message = error.response?.data?.message || 'Terjadi kesalahan saat mengimpor data.';
            showMessage(message, 'error');
        }
    });

    function showMessage(message, type) {
        const messageDiv = document.getElementById('message');
        messageDiv.textContent = message;
        messageDiv.className = type === 'success' ? 'text-green-600' : 'text-red-600';
        messageDiv.classList.remove('hidden');
    }
</script>
@endsection
