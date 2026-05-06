@auth
    @if(auth()->user()->isAdmin())
        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
            Admin Dashboard
        </x-nav-link>
    @endif
@endauth