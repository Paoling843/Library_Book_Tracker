<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Crimson+Pro:ital,wght@0,300;0,400;0,500;1,300;1,400&family=DM+Mono:wght@300;400&display=swap');

    .lib-nav-link {
        font-family: 'Crimson Pro', Georgia, serif;
        font-size: 1rem;
        font-weight: 400;
        color: #8a7660;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        padding: 1rem;
        border-bottom: 2px solid transparent;
        transition: color 0.18s ease, border-color 0.18s ease;
    }
    .lib-nav-link:hover { color: #2c1810; }
    .lib-nav-link.active { color: #2c1810; font-weight: 500; border-bottom-color: #8a6640; }

    .dark .lib-nav-link { color: #9a8878; }
    .dark .lib-nav-link:hover { color: #e8d8c4; }
    .dark .lib-nav-link.active { color: #e8d8c4; border-bottom-color: #c49a6c; }

    .lib-user-btn {
        font-family: 'Crimson Pro', Georgia, serif;
        font-size: 0.95rem;
        color: #6a5040;
        background: transparent;
        border: 1px solid #d4c4b0;
        border-radius: 2px;
        padding: 0.35rem 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        cursor: pointer;
        transition: border-color 0.18s ease, color 0.18s ease, background 0.18s ease;
    }
    .lib-user-btn:hover { border-color: #8a6640; color: #2c1810; background: #fffdf9; }

    .dark .lib-user-btn { color: #9a8878; border-color: rgba(138,102,64,0.35); }
    .dark .lib-user-btn:hover { color: #e8d8c4; border-color: #c49a6c; background: #2a2119; }

    .lib-dropdown {
        background: #fffdf9;
        border: 1px solid #e0d0bc;
        border-radius: 2px;
        box-shadow: 0 8px 24px rgba(44,24,16,0.1);
        overflow: hidden;
        min-width: 11rem;
    }
    .dark .lib-dropdown { background: #2a2119; border-color: rgba(138,102,64,0.25); }

    .lib-dropdown-link {
        display: block;
        font-family: 'Crimson Pro', Georgia, serif;
        font-size: 0.95rem;
        color: #6a5040;
        padding: 0.6rem 1rem;
        text-decoration: none;
        transition: background 0.15s ease, color 0.15s ease;
        background: transparent;
        border: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
    }
    .lib-dropdown-link:hover { background: #f5f0ea; color: #2c1810; }
    .dark .lib-dropdown-link { color: #9a8878; }
    .dark .lib-dropdown-link:hover { background: #3a2a1f; color: #e8d8c4; }

    .lib-dropdown-divider { border-top: 1px solid #e0d0bc; }
    .dark .lib-dropdown-divider { border-top-color: rgba(138,102,64,0.25); }

    .lib-mobile-link {
        display: block;
        font-family: 'Crimson Pro', Georgia, serif;
        font-size: 1rem;
        color: #8a7660;
        padding: 0.6rem 1rem;
        border-left: 3px solid transparent;
        text-decoration: none;
        transition: all 0.15s ease;
    }
    .lib-mobile-link:hover { color: #2c1810; background: #f5f0ea; border-left-color: #d4c4b0; }
    .lib-mobile-link.active { color: #2c1810; background: #f5f0ea; border-left-color: #8a6640; font-weight: 500; }
    .dark .lib-mobile-link { color: #9a8878; }
    .dark .lib-mobile-link:hover { color: #e8d8c4; background: #2a2119; }
    .dark .lib-mobile-link.active { color: #e8d8c4; background: #2a2119; border-left-color: #c49a6c; }
</style>

<nav x-data="{ open: false }" class="bg-[#f0e8dc] border-b border-[#e0d0bc] dark:bg-[#17110d] dark:border-[rgba(138,102,64,0.25)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- Left: logo + links --}}
            <div class="flex items-center gap-8">

                {{-- Logo --}}
                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="shrink-0 transition hover:opacity-75">
                    <x-application-logo class="block h-9 w-auto fill-current text-[#2c1810] dark:text-[#e8d8c4]" />
                </a>

                {{-- Desktop links --}}
                <div class="hidden sm:flex items-center gap-6 h-full">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                           class="lib-nav-link h-full {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            {{ __('Dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}"
                           class="lib-nav-link h-full {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            {{ __('Dashboard') }}
                        </a>
                    @endif

                    <a href="{{ route('books.index') }}"
                       class="lib-nav-link h-full {{ request()->routeIs('books.*') ? 'active' : '' }}">
                        {{ __('Books') }}
                    </a>

                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('categories.index') }}"
                           class="lib-nav-link h-full {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                            {{ __('Categories') }}
                        </a>

                    @endif
                </div>
            </div>

            {{-- Right: user dropdown --}}
            <div class="hidden sm:flex items-center">
                <div class="relative" x-data="{ open: false }" @click.outside="open = false">

                    <button @click="open = !open" class="lib-user-btn">
                        {{ Auth::user()->name }}
                        <svg class="fill-current h-3.5 w-3.5 opacity-60" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150 transform"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75 transform"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="lib-dropdown absolute right-0 top-full mt-2 z-50"
                        style="display:none"
                        @click="open = false"
                    >


                        <div class="lib-dropdown-divider">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="lib-dropdown-link">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Hamburger --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-sm text-[#9a8470] dark:text-[#9a8878] hover:text-[#2c1810] dark:hover:text-[#c49a6c] hover:bg-[#fffdf9] dark:hover:bg-[#2a2119] focus:outline-none transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-[#fffdf9] dark:bg-[#2a2119] border-t border-[#e0d0bc] dark:border-[rgba(138,102,64,0.25)]">
        <div class="py-2">
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="lib-mobile-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">{{ __('Dashboard') }}</a>
            @else
                <a href="{{ route('dashboard') }}" class="lib-mobile-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">{{ __('Dashboard') }}</a>
            @endif

            <a href="{{ route('books.index') }}" class="lib-mobile-link {{ request()->routeIs('books.*') ? 'active' : '' }}">{{ __('Books') }}</a>

        </div>

        <div class="py-3 border-t border-[#e0d0bc] dark:border-[rgba(138,102,64,0.25)]">
            <div class="px-4 mb-2">
                <p class="font-medium text-[#2c1810] dark:text-[#e8d8c4]" style="font-family:'Crimson Pro',Georgia,serif;">{{ Auth::user()->name }}</p>
                <p class="text-sm text-[#8a7660] dark:text-[#9a8878]" style="font-family:'DM Mono',monospace;font-size:0.7rem;letter-spacing:0.05em;">{{ Auth::user()->email }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="lib-mobile-link w-full text-left">{{ __('Log Out') }}</button>
            </form>
        </div>
    </div>
</nav>