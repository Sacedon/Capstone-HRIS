<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>




    <x-sidebar.link
        title="Request Leave"
        href="{{ route('leave-requests.create') }}"
        :isActive="request()->routeIs('leave-requests.create')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="List of Employees"
        href="{{ route('employee-users.index') }}"
        :isActive="request()->routeIs('employee-users.index')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>



    <x-sidebar.dropdown
        title="Manage Users"
        :active="Str::startsWith(request()->route()->uri(), 'index')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Users"
            href="{{ route('users.index') }}"
            :active="request()->routeIs('users.index.*')"
        />
        <x-sidebar.sublink
            title="Departments"
            href="{{ route('departments.index') }}"
            :active="request()->routeIs('departments.index')"
        />
    </x-sidebar.dropdown>




    <x-sidebar.link
    title="Leave Management"
    href="{{ route('leave-requests.index') }}"
    :isActive="request()->routeIs('leave-requests.index')"
>
    <x-slot name="icon">
        <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
    </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Evaluation"
        href="{{ route('evaluations.index') }}"
        :isActive="request()->routeIs('evaluations.index')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    @php
    $user = auth()->user();
    @endphp

    @if ($user && $user->role === 'admin')
    <x-sidebar.link
        title="Login/Logout Records"
        href="{{ route('logs.index') }}"
        :isActive="request()->routeIs('logs.index')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    @endif




</x-perfect-scrollbar>
