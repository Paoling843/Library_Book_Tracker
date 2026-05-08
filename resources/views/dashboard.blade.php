<x-app-layout>
    <x-slot name="header">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Crimson+Pro:ital,wght@0,300;0,400;0,500;1,300;1,400&family=DM+Mono:wght@300;400&display=swap');

            .lib-header-title { font-family: 'Playfair Display', Georgia, serif; font-size: 1.5rem; font-weight: 600; color: #2c1810; }
            .lib-header-subtitle { font-family: 'Crimson Pro', Georgia, serif; font-style: italic; font-size: 0.875rem; color: #8a7660; margin-top: 0.2rem; }
            .dark .lib-header-title { color: #e8d8c4; }
            .dark .lib-header-subtitle { color: #9a8878; }
        </style>
        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
            @if(auth()->user()->isAdmin())
                <h2 class="lib-header-title">{{ __('Admin Dashboard') }}</h2>
                <p class="lib-header-subtitle">{{ __('Welcome back, :name', ['name' => auth()->user()->name]) }}</p>
            @else
                <h2 class="lib-header-title">{{ __('Reading Room') }}</h2>
                <p class="lib-header-subtitle">{{ __('Your catalogue is ready for the next chapter') }}</p>
            @endif
        </div>
    </x-slot>

    <style>
        .lib-page { font-family: 'Crimson Pro', Georgia, serif; background: #f9f4ee; min-height: 100vh; }
        .dark .lib-page { background: transparent; }
        .lib-card {
            border: 1px solid #e0d0bc; border-radius: 2px; background: #fffdf9; overflow: hidden;
            animation: lib-fadein 0.42s ease both;
        }
        .dark .lib-card { background: #1e1812; border-color: rgba(138,102,64,0.25); }
        .lib-card-head {
            padding: 1.2rem 1.5rem;
            background: linear-gradient(135deg, #2c1810 0%, #4a2c1a 60%, #6b3d20 100%);
            color: #f5ede0;
        }
        .lib-card-title { font-family: 'Playfair Display', Georgia, serif; font-size: 1.25rem; font-weight: 600; }
        .lib-card-body { padding: 1.5rem; color: #2c1810; font-size: 1.05rem; }
        .dark .lib-card-body { color: #e8d8c4; }
        .lib-meta { font-family: 'DM Mono', monospace; font-size: 0.65rem; letter-spacing: 0.18em; text-transform: uppercase; color: #9a8470; margin-top: 0.6rem; }
        .dark .lib-meta { color: #9a8878; }
        @keyframes lib-fadein { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: translateY(0); } }
    </style>

    <div class="lib-page py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lib-card">
                <div class="lib-card-head">
                    <h3 class="lib-card-title">{{ __('Welcome back to the stacks') }}</h3>
                </div>
                <div class="lib-card-body">
                    {{ __('You are signed in and ready to continue cataloguing your library.') }}
                    <p class="lib-meta">{{ now()->format('l, F j, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
