<x-app-layout>
    <x-slot name="header">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Crimson+Pro:ital,wght@0,300;0,400;0,500;1,300;1,400&family=DM+Mono:wght@300;400&display=swap');
            
            .lib-header-wrap { display: flex; justify-content: space-between; align-items: center; gap: 1rem; padding-inline: 150px; background: #f9f4ee;  }
            .lib-header-title { font-family: 'Playfair Display', Georgia, serif; font-size: 1.5rem; font-weight: 600; : #2c1810; }
            .lib-header-subtitle { font-family: 'Crimson Pro', Georgia, serif; font-size: 0.875rem; font-style: italic; color: #8a7660; margin-top: 0.2rem; }
            .lib-header-date { font-family: 'DM Mono', monospace; font-size: 0.65rem; letter-spacing: 0.18em; text-transform: uppercase; color: #9a8470; }
        </style>

        
        <div class="lib-header-wrap">
            <div>
                <h2 class="lib-header-title">{{ __('Archivist Console') }}</h2>
                <p class="lib-header-subtitle">{{ __('Welcome back, :name', ['name' => auth()->user()->name]) }}</p>
            </div>
            <span class="lib-header-date">{{ now()->format('l, F j, Y') }}</span>
        </div>
    </x-slot>

    <style>
        .lib-page { font-family: 'Crimson Pro', Georgia, serif; background: #f9f4ee; min-height: 100vh; }
        .dark .lib-page { background: transparent; }
        .lib-section-label { font-family: 'DM Mono', monospace; font-size: 0.65rem; letter-spacing: 0.18em; text-transform: uppercase; color: #9a8470; margin-bottom: 0.8rem; }
        .lib-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1.2rem; }
        .lib-stat {
            background: #fffdf9; border: 1px solid #e0d0bc; border-radius: 2px; overflow: hidden;
            animation: lib-fadein 0.38s ease both;
        }
        .lib-stat-head { background: linear-gradient(135deg, #2c1810 0%, #4a2c1a 60%, #6b3d20 100%); color: #f5ede0; padding: 0.8rem 1rem; font-family: 'DM Mono', monospace; font-size: 0.62rem; letter-spacing: 0.16em; text-transform: uppercase; }
        .lib-stat-body { padding: 1rem; }
        .lib-stat-title { font-family: 'Crimson Pro', Georgia, serif; color: #5a4838; font-size: 0.95rem; font-style: italic; }
        .lib-stat-value { font-family: 'Playfair Display', Georgia, serif; color: #2c1810; font-size: 2rem; font-weight: 700; line-height: 1.1; margin-top: 0.2rem; }
        .dark .lib-stat { background: #1e1812; border-color: rgba(138,102,64,0.25); }
        .dark .lib-stat-title { color: #9a8878; }
        .dark .lib-stat-value { color: #e8d8c4; }

        .lib-actions { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 0.8rem; }
        .lib-action {
            border-radius: 2px; border: 1px solid #8a6640; color: #8a6640; background: transparent; text-decoration: none;
            font-family: 'DM Mono', monospace; font-size: 0.65rem; letter-spacing: 0.12em; text-transform: uppercase;
            padding: 0.65rem 0.9rem; display: inline-flex; justify-content: center; transition: all 0.18s ease;
        }
        .lib-action:hover { background: #8a6640; color: #f5ede0; }
        .dark .lib-action { border-color: #c49a6c; color: #c49a6c; }
        .dark .lib-action:hover { background: #c49a6c; color: #1e1812; }

        .lib-table-card { margin-top: 1.5rem; border: 1px solid #e0d0bc; border-radius: 2px; background: #fffdf9; overflow: hidden; }
        .dark .lib-table-card { background: #1e1812; border-color: rgba(138,102,64,0.25); }
        .lib-table-head { display: flex; justify-content: space-between; align-items: center; gap: 1rem; padding: 1rem 1.25rem; border-bottom: 1px solid #e0d0bc; }
        .dark .lib-table-head { border-bottom-color: rgba(138,102,64,0.25); }
        .lib-table-title { font-family: 'Playfair Display', Georgia, serif; font-size: 1.2rem; color: #2c1810; }
        .dark .lib-table-title { color: #e8d8c4; }
        .lib-table-link { font-family: 'DM Mono', monospace; font-size: 0.65rem; letter-spacing: 0.12em; text-transform: uppercase; color: #8a6640; text-decoration: none; }
        .lib-table-link:hover { color: #c49a6c; }
        .lib-table { width: 100%; border-collapse: collapse; }
        .lib-table th { font-family: 'DM Mono', monospace; font-size: 0.6rem; letter-spacing: 0.16em; text-transform: uppercase; color: #6a5040; text-align: left; padding: 0.75rem 1.25rem; border-bottom: 1px solid #efe2d2; }
        .lib-table td { padding: 0.85rem 1.25rem; border-bottom: 1px solid #efe2d2; color: #2c1810; }
        .lib-table td.mono { font-family: 'DM Mono', monospace; font-size: 0.8rem; letter-spacing: 0.05em; color: #6a5040; }
        .lib-table td.desc { color: #5a4838; font-style: italic; }
        .dark .lib-table th { color: #9a8878; border-bottom-color: rgba(138,102,64,0.25); }
        .dark .lib-table td { color: #e8d8c4; border-bottom-color: rgba(138,102,64,0.15); }
        .dark .lib-table td.mono { color: #9a8878; }
        .dark .lib-table td.desc { color: #9a8878; }

        .lib-btn { display: inline-flex; border-radius: 2px; padding: 0.4rem 0.7rem; font-family: 'DM Mono', monospace; font-size: 0.6rem; letter-spacing: 0.12em; text-transform: uppercase; text-decoration: none; background: transparent; }
        .lib-btn-edit { border: 1px solid #8a6640; color: #8a6640; }
        .lib-btn-edit:hover { background: #8a6640; color: #f5ede0; }
        .lib-btn-delete { border: 1px solid #b54a3a; color: #b54a3a; }
        .lib-btn-delete:hover { background: #b54a3a; color: #fff; }

        .lib-empty { text-align: center; padding: 2.5rem 1rem; }
        .lib-empty span { display: block; font-family: 'Playfair Display', Georgia, serif; font-size: 2.5rem; color: #e0d0bc; line-height: 1; margin-bottom: 0.5rem; }
        .lib-empty h4 { font-family: 'Playfair Display', Georgia, serif; font-size: 1.2rem; color: #2c1810; margin-bottom: 0.2rem; }
        .lib-empty p { font-style: italic; color: #9a8470; }
        .dark .lib-empty h4 { color: #e8d8c4; }
        .dark .lib-empty p { color: #9a8878; }

        @keyframes lib-fadein { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: translateY(0); } }
    </style>

    <div class="lib-page py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div>
                <p class="lib-section-label">{{ __('System counters') }}</p>
                <div class="lib-grid">
                    <div class="lib-stat">
                        <div class="lib-stat-head">{{ __('Archive') }}</div>
                        <div class="lib-stat-body">
                            <p class="lib-stat-title">{{ __('Total Books') }}</p>
                            <p class="lib-stat-value">{{ \App\Models\Book::count() }}</p>
                        </div>
                    </div>
                    <div class="lib-stat">
                        <div class="lib-stat-head">{{ __('Taxonomy') }}</div>
                        <div class="lib-stat-body">
                            <p class="lib-stat-title">{{ __('Categories') }}</p>
                            <p class="lib-stat-value">{{ \App\Models\Category::count() }}</p>
                        </div>
                    </div>
                    <div class="lib-stat">
                        <div class="lib-stat-head">{{ __('Membership') }}</div>
                        <div class="lib-stat-body">
                            <p class="lib-stat-title">{{ __('Users') }}</p>
                            <p class="lib-stat-value">{{ \App\Models\User::count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <p class="lib-section-label">{{ __('Quick actions') }}</p>
                <div class="lib-actions">
                    <a href="{{ route('books.index') }}" class="lib-action">{{ __('Manage Books') }}</a>
                    <a href="{{ route('books.create') }}" class="lib-action">{{ __('Add New Book') }}</a>
                    <a href="{{ route('categories.index') }}" class="lib-action">{{ __('Manage Categories') }}</a>
                    <a href="{{ route('users.index') }}" class="lib-action">{{ __('Manage Users') }}</a>
                </div>
            </div>

            <div class="lib-table-card">
                <div class="lib-table-head">
                    <h3 class="lib-table-title">{{ __('Recently Added Books') }}</h3>
                    <a href="{{ route('books.index') }}" class="lib-table-link">{{ __('View Catalogue') }}</a>
                </div>
                <div style="overflow-x:auto;">
                    <table class="lib-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Added') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Book::with('category')->latest()->take(5)->get() as $i => $book)
                                <tr>
                                    <td class="mono">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td class="desc">{{ $book->category->name ?? '—' }}</td>
                                    <td class="mono">{{ $book->created_at->format('Y-m-d') }}</td>
                                    <td style="display:flex; gap:0.45rem;">
                                        <a href="{{ route('books.edit', $book) }}" class="lib-btn lib-btn-edit">{{ __('Edit') }}</a>
                                        <form method="POST" action="{{ route('books.destroy', $book) }}" onsubmit="return confirm('Remove this volume from the catalogue?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="lib-btn lib-btn-delete">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="lib-empty">
                                            <span>&#x2767;</span>
                                            <h4>{{ __('The shelves are bare') }}</h4>
                                            <p>{{ __('No volumes have been catalogued yet.') }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>