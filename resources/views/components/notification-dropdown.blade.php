<div class="relative">
    <button
        type="button"
        class="relative p-2 text-gray-500 rounded-full hover:text-gray-700 focus:outline-none focus:ring focus:ring-purple-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200"
        aria-label="Notifications"
        x-on:click="open = !open"
    >
        @if (auth()->user()->unreadNotifications->isNotEmpty())
            <!-- Add a red badge with the number of unread notifications -->
            <span class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                {{ auth()->user()->unreadNotifications->count() }}
            </span>
        @endif
        <div class="ml-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg>
        </div>
    </button>
    <!-- Add your notification dropdown here -->
    <div
        class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 dark:bg-dark-eval-2 dark:border-dark-eval-3 shadow-md rounded-md"
        x-show="open"
        @click.away="open = false"
    >
        <!-- Replace this with your notification items -->
        <div class="p-4">
            <div class="font-semibold mb-2">Notifications</div>
            @foreach(auth()->user()->unreadNotifications as $notification)
                <a href="{{ $notification->data['link'] }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                    {{ $notification->data['message'] }}
                </a>
                <!-- Mark the notification as read -->
                {{ $notification->markAsRead() }}
            @endforeach
            @if (auth()->user()->unreadNotifications->isEmpty())
                <p class="text-gray-500 py-2">No new notifications.</p>
            @endif
        </div>
    </div>
</div>
