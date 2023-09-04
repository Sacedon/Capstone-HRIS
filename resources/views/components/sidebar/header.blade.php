<div class="flex items-center justify-between flex-shrink-0 px-3">
    <!-- Profile Link -->
    <a href="{{ route('profile-show') }}" class="inline-flex flex-col items-center gap-4">
        <!-- Profile Picture -->
        <div class="w-32 h-32 rounded-full overflow-hidden">
            @if (Auth::user()->profile_picture)
                <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }} Profile Picture"
                    class="w-full h-full object-cover" />
            @else
                <img src="{{ asset('images/default-profile.jpeg') }}" alt="Default Profile Picture"
                    class="w-full h-full object-cover" />
            @endif
        </div>
        <!-- User's Name -->
        <h1 class="text-xl font-semibold mt-2">{{ Auth::user()->surname }}, {{ Auth::user()->first_name }}</h1>
    </a>

    <!-- Toggle Button -->
    <x-button
        type="button"
        icon-only
        sr-text="Toggle sidebar"
        variant="secondary"
        x-show="isSidebarOpen || isSidebarHovered"
        x-on:click="isSidebarOpen = !isSidebarOpen"
    >
        <!-- Toggle Button Icons -->
        <x-icons.menu-fold-right
            x-show="!isSidebarOpen"
            aria-hidden="true"
            class="hidden w-6 h-6 lg:block"
        />

        <x-icons.menu-fold-left
            x-show="isSidebarOpen"
            aria-hidden="true"
            class="hidden w-6 h-6 lg:block"
        />

        <x-heroicon-o-x
            aria-hidden="true"
            class="w-6 h-6 lg:hidden"
        />
    </x-button>
</div>
