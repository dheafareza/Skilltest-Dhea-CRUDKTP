<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<nav x-data="{ open: false }" class="bg-purple-600 border-b border-purple-500 dark:bg-blue-900 dark:border-blue-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
        <div class="flex" style="font-family: 'Roboto', sans-serif; font-weight: 700;">
    <!-- Tautan Dashboard -->
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-yellow-300">
            {{ __('Dashboard') }}
        </x-nav-link>

        <!-- Tautan Data KTP -->
        <x-nav-link :href="route('ktp.index')" :active="request()->routeIs('ktp.index')" class="ml-6 text-white hover:text-yellow-300">
            {{ __('Data KTP') }}
        </x-nav-link>

        <!-- Tautan Export -->
        <x-nav-link :href="route('export')" :active="request()->routeIs('export')" class="ml-6 text-white hover:text-yellow-300">
            {{ __('Export') }}
        </x-nav-link>

        <!-- Tautan Khusus Admin -->
        @auth
        @if (auth()->user()->role === 'admin')
        <x-nav-link :href="route('import')" :active="request()->routeIs('import')" class="ml-6 text-white hover:text-yellow-300">
            {{ __('Import') }}
        </x-nav-link>

        <x-nav-link :href="route('admin.activities')" :active="request()->routeIs('admin.activities')" class="ml-6 text-white hover:text-yellow-300">
            {{ __('User Activities') }}
        </x-nav-link>
        @endif
        @endauth
    </div>
</div>



            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-white hover:text-yellow-300 focus:outline-none focus:text-yellow-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu (Responsive) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-yellow-300 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Navigasi Responsif -->
    <div :class="{ 'block': open, 'hidden': ! open }" class="hidden sm:hidden bg-purple-500">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-yellow-300">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Pengaturan Responsif -->
        <div class="pt-4 pb-1 border-t border-purple-400">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-200">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
