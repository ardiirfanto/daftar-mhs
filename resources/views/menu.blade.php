<header class="bg-white shadow">
    <div class="max-w-7xl flex flex-row justify-between mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @if (Auth::user()->role->name == 'admin')
            <div class="flex flex-row w-full gap-2">
                <a href="{{ route('admin.dashboard') }}" class="text-sm text-white font-semibold bg-gray-400 hover:bg-gray-600 py-2 px-2 rounded-lg">
                    Dashboard
                </a>
                <a href="{{ route('admin.mahasiswa') }}" class="text-sm text-white font-semibold bg-gray-400 hover:bg-gray-600 py-2 px-2 rounded-lg">
                    Data Mahasiswa
                </a>
            </div>
        @else

        @endif

        {{-- Alert --}}
        @if (session('success'))
            <div class="bg-green-300 font-semibold text-green-700 py-2 px-2 rounded w-[50%]">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-300 font-semibold text-red-700 py-2 px-2 rounded w-[50%]">
                {{ session('error') }}
            </div>
        @endif
    </div>
</header>
