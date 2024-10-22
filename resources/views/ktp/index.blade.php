@extends('layouts.app')

@section('content')
<style>
    /* Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
    }

    /* Styling untuk container utama */
    .container {
        margin: 0 auto;
        padding: 20px;
        max-width: 45000px;
    }

    /* Styling untuk card dan table */
    .card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .card-header {
        background-color: #003366;
        color: #fff;
        padding: 15px;
        font-size: 68px;
        font-weight: 600;
        text-align: center;
    }

    .card-body {
        padding: 20px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .table th,
    .table td {
        padding: 12px 15px;
        border-bottom: 1px solid #000;
        text-align: left;
    }

    .table th {
        background-color: #f4f4f4;
        color: #333;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.1em;
    }

    .table tr:hover {
        background-color: #f9f9f9;
    }

    .table img {
        border-radius: 5px;
        width: 40px;
        height: 40px;
    }

    .action-buttons a {
        margin-right: 10px;
        padding: 8px 12px;
        font-size: 14px;
        border-radius: 5px;
        color: #fff;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .action-buttons .btn-delete {
        margin-right: 10px;
        padding: 8px 12px;
        font-size: 14px;
        border-radius: 5px;
        color: #fff;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .action-buttons .btn-view {
        background-color: #4a90e2;
    }

    .action-buttons .btn-view:hover {
        background-color: #417bb7;
    }

    .action-buttons .btn-edit {
        background-color: #00c853;
    }

    .action-buttons .btn-edit:hover {
        background-color: #009624;
    }

    .action-buttons .btn-delete {
        background-color: #d32f2f;
    }

    .action-buttons .btn-delete:hover {
        background-color: #b71c1c;
    }

    /* Styling untuk pagination */
    .pagination {
        display: flex;
        justify-content: center;
        padding: 10px 0;
    }

    .pagination a,
    .pagination span {
        padding: 5px 7px;
        margin: 0 5px;
        text-decoration: none;
        border-radius: 10px;
        background-color: #e0e0e0;
        color: #333;
        transition: background-color 0.3s ease;
    }

    .pagination a:hover {
        background-color: #4a90e2;
        color: #fff;
    }

    .pagination .active a {
        background-color: #003366;
        color: #fff;
    }

    .pagination .disabled span {
        background-color: #ccc;
        pointer-events: none;
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            Data KTP
        </div>
        <div class="card-body">
        <div class="flex justify-end mb-6">
                @auth
                @if (auth()->user()->role === 'admin')
                <a href="{{ route('ktp.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
        Tambah KTP
    </a>
                @endif
                @endauth
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="ktp-body">
                    <!-- Data will be loaded via JavaScript -->
                </tbody>
            </table>

            <input type="hidden" id="currentPage" value="{{ request('page', 1) }}">
            <div id="pagination"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const initialPage = getQueryParameter('page'); // Ambil halaman dari URL
        loadKTPData(initialPage); // Muat data sesuai halaman

        async function loadKTPData(page = 1) {
            try {
                const response = await axios.get(`/api/ktp?page=${page}`);
                const ktps = response.data.data;
                const paginationLinks = response.data.links;
                const currentPage = response.data.meta.current_page;

                renderTable(ktps, currentPage);
                renderPagination(paginationLinks);
            } catch (error) {
                console.error('Error fetching KTP data:', error);
            }
        }

        function getQueryParameter(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param) || 1;
        }

        function renderTable(ktps, currentPage) {
            const tbody = document.getElementById('ktp-body');
            const userRole = "{{ auth()->user()->role ?? 'guest' }}";
            tbody.innerHTML = '';

            ktps.forEach(ktp => {
                let actionButtons = `
                <a href="/ktp/${ktp.id}?page=${currentPage}" class="text-blue-500 hover:underline">Lihat</a>
            `;

                if (userRole === 'admin') {
                    actionButtons += `
                <a href="/ktp/${ktp.id}/edit?page=${currentPage}" class="ml-4 text-green-500 hover:underline">Edit</a>
                <button type="button" onclick="deleteKTP(${ktp.id})" class="ml-4 text-red-500 hover:underline">Hapus</button>
            `;
                }

                const row = `
                <tr>
                    <td>${ktp.nama}</td>
                    <td>${ktp.nik}</td>
                    <td>${ktp.alamat}</td>
                    <td><img src="{{ asset('storage') }}/${ktp.foto}" alt="Foto"></td>
                     <td class="action-buttons">
                        <a href="/ktp/${ktp.id}" class="btn-view">Lihat</a>
                        <a href="/ktp/${ktp.id}/edit" class="btn-edit">Edit</a>
                        <button onclick="deleteKTP(${ktp.id})" class="btn-delete">Hapus</button>
                    </td>
                </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            });
        }

        function renderPagination(links) {
            const paginationDiv = document.getElementById('pagination');
            paginationDiv.innerHTML = '';

            const ul = document.createElement('ul');
            ul.classList.add('pagination');

            links.forEach(link => {
                const li = document.createElement('li');
                li.classList.add('page-item');

                const anchor = document.createElement('a');
                anchor.classList.add('page-link');

                if (link.active) {
                    li.classList.add('active');
                    anchor.innerHTML = `<span>${link.label}</span>`;
                } else if (link.url) {
                    anchor.href = '#';
                    anchor.innerHTML = link.label;
                    anchor.onclick = (e) => {
                        e.preventDefault();
                        const page = getPageNumber(link.url);
                        loadKTPData(page);
                    };
                } else {
                    li.classList.add('disabled');
                    anchor.innerHTML = `<span>${link.label}</span>`;
                }

                li.appendChild(anchor);
                ul.appendChild(li);
            });

            paginationDiv.appendChild(ul);
        }

        function getPageNumber(url) {
            const params = new URLSearchParams(url.split('?')[1]);
            return params.get('page') || 1;
        }

        window.deleteKTP = function(id) {
            const currentPage = document.getElementById('currentPage').value;
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data KTP akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        await axios.delete(`/api/ktp/${id}`);
                        Swal.fire('Dihapus!', 'Data KTP berhasil dihapus.', 'success');
                        loadKTPData(currentPage); // Refresh data setelah penghapusan
                    } catch (error) {
                        console.error('Error deleting KTP:', error);
                        Swal.fire('Error!', 'Gagal menghapus data KTP.', 'error');
                    }
                }
            });
        };
    });
</script>
@endsection
