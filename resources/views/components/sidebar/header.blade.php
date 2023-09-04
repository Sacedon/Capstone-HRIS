<div class="flex items-center justify-between flex-shrink-0 px-3">
    <!-- Profile Link -->
    <a href="{{ route('profile-show')}}" class="inline-flex items-center gap-2">
        <!-- Profile Picture -->
        @if (Auth::user()->profile_picture)
                            <div class="mb-4">
                                <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }} Profile Picture"
                                    class="w-32 h-32 object-cover rounded-full">
                            </div>
                        @else
                            <div class="text-gray-400 mb-4">No Profile Picture</div>
                        @endif
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
