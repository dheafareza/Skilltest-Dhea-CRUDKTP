@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-green-200 to-blue-300 flex items-center justify-center">
    <div class="max-w-7xl mx-auto p-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden p-10">
            <h1 class="text-3xl font-semibold mb-6 text-gray-800 dark:text-black text-center">
                Aktivitas Pengguna
            </h1>

            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            User
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Aktivitas
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            URL
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Waktu
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($activities as $activity)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                        <td class="px-6 py-4 text-gray-900 dark:text-black">{{ $activity->user->name }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-black">{{ $activity->activity }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-black">{{ $activity->url }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-black">{{ $activity->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $activities->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>
@endsection
