<x-app-layout>
    <x-slot name="header">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Crimson+Pro:ital,wght@0,300;0,400;0,500;1,300;1,400&family=DM+Mono:wght@300;400&display=swap');

            .lib-header-wrap { display: flex; justify-content: space-between; align-items: center; padding-inline: 150px; background: #f9f4ee; gap: 1rem; }
            .lib-header-title { font-family: 'Playfair Display', Georgia, serif; font-size: 1.5rem; font-weight: 600; color: #2c1810; }
            .lib-header-subtitle { font-family: 'Crimson Pro', Georgia, serif; font-size: 0.875rem; font-style: italic; font-weight: 300; color: #8a7660; margin-top: 0.2rem; }
            .dark .lib-header-title { color: #e8d8c4; }
            .dark .lib-header-subtitle { color: #9a8878; }

            .lib-add-btn {
                font-family: 'Crimson Pro', Georgia, serif;
                font-size: 0.95rem;
                font-weight: 500;
                letter-spacing: 0.04em;
                text-transform: uppercase;
                background: #2c1810;
                color: #f5ede0;
                border-radius: 2px;
                padding: 0.5rem 1.25rem;
                border: 1px solid #2c1810;
                text-decoration: none;
                transition: background 0.2s ease, box-shadow 0.2s ease;
            }

            .lib-add-btn:hover { background: #4a2c1a; box-shadow: 0 4px 16px rgba(44,24,16,0.18); }
            .dark .lib-add-btn { background: #c49a6c; border-color: #c49a6c; color: #1e1812; }
        </style>
        <div class="lib-header-wrap">
            <div>
                <h2 class="lib-header-title">{{ __('Category Archive') }}</h2>
                <p class="lib-header-subtitle">{{ __('Curate the genres and shelves of your collection') }}</p>
            </div>
            <a href="{{ route('categories.create') }}" class="lib-add-btn">{{ __('Add Category') }}</a>
        </div>
    </x-slot>

    <style>
        .lib-page { font-family: 'Crimson Pro', Georgia, serif; background: #f9f4ee; min-height: 100vh; }
        .dark .lib-page { background: transparent; }
        .lib-section-meta { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
        .lib-section-label { font-family: 'DM Mono', monospace; font-size: 0.65rem; font-weight: 300; letter-spacing: 0.18em; text-transform: uppercase; color: #9a8470; }
        .lib-section-rule { flex: 1; height: 1px; background: linear-gradient(to right, #c9b49a, transparent); }
        .dark .lib-section-label { color: #9a8878; }
        .dark .lib-section-rule { background: linear-gradient(to right, rgba(201,180,154,0.35), transparent); }

        .lib-alert {
            display: flex; align-items: center; gap: 0.65rem; margin-bottom: 1.75rem; padding: 0.9rem 1.25rem;
            background: #fdf8f1; border: 1px solid #d4b896; border-left: 4px solid #8a6640; border-radius: 2px;
            font-family: 'Crimson Pro', Georgia, serif; font-size: 1.05rem; color: #5a3e28;
        }

        .lib-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; }
        .lib-card {
            background: #fffdf9; border: 1px solid #e0d0bc; border-radius: 2px; overflow: hidden; position: relative;
            transition: transform 0.22s ease, box-shadow 0.22s ease; animation: lib-fadein 0.38s ease both;
        }

        .lib-card::before {
            content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px;
            background: linear-gradient(to bottom, #8a6640, #c49a6c); opacity: 0; transition: opacity 0.22s ease;
        }

        .lib-card:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(100,70,40,0.12), 0 2px 6px rgba(100,70,40,0.06); }
        .lib-card:hover::before { opacity: 1; }
        .dark .lib-card { background: #1e1812; border-color: rgba(138,102,64,0.25); }

        .lib-card-spine {
            padding: 1.4rem 1.5rem 1.2rem; background: linear-gradient(135deg, #2c1810 0%, #4a2c1a 60%, #6b3d20 100%);
            position: relative; overflow: hidden;
        }

        .lib-card-spine::after {
            content: ''; position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        .lib-card-meta { position: relative; z-index: 1; font-family: 'DM Mono', monospace; font-size: 0.6rem; font-weight: 300; letter-spacing: 0.2em; text-transform: uppercase; color: rgba(245,237,224,0.5); margin-bottom: 0.6rem; }
        .lib-card-title { position: relative; z-index: 1; font-family: 'Playfair Display', Georgia, serif; font-size: 1.2rem; font-weight: 700; color: #f5ede0; }
        .lib-card-tag { margin-top: 0.7rem; display: inline-block; padding: 0.2rem 0.65rem; border: 1px solid rgba(245,237,224,0.22); border-radius: 2px; font-family: 'DM Mono', monospace; font-size: 0.6rem; letter-spacing: 0.15em; text-transform: uppercase; color: rgba(245,237,224,0.78); }
        .lib-card-body { padding: 1.25rem 1.5rem; }
        .lib-field-label { font-family: 'DM Mono', monospace; font-size: 0.6rem; font-weight: 300; letter-spacing: 0.18em; text-transform: uppercase; color: #9a8470; margin-bottom: 0.2rem; }
        .lib-field-value { font-family: 'Crimson Pro', Georgia, serif; font-size: 1.05rem; color: #2c1810; }
        .lib-field-value.mono { font-family: 'DM Mono', monospace; font-size: 0.8rem; letter-spacing: 0.05em; color: #6a5040; }
        .dark .lib-field-label { color: #6a5a4a; }
        .dark .lib-field-value { color: #e8d8c4; }
        .dark .lib-field-value.mono { color: #9a8878; }
        .lib-card-divider { height: 1px; margin: 0 1.5rem; background: linear-gradient(to right, #e0d0bc, transparent); }
        .dark .lib-card-divider { background: linear-gradient(to right, rgba(138,102,64,0.25), transparent); }
        .lib-card-actions { padding: 1rem 1.5rem; display: flex; gap: 0.75rem; }

        .lib-btn { flex: 1; text-align: center; display: inline-flex; align-items: center; justify-content: center; border-radius: 2px; padding: 0.55rem 1rem; background: transparent; font-family: 'DM Mono', monospace; font-size: 0.65rem; letter-spacing: 0.12em; text-transform: uppercase; text-decoration: none; transition: all 0.18s ease; }
        .lib-btn-edit { border: 1px solid #8a6640; color: #8a6640; }
        .lib-btn-edit:hover { background: #8a6640; color: #f5ede0; }
        .lib-btn-delete { border: 1px solid #b54a3a; color: #b54a3a; }
        .lib-btn-delete:hover { background: #b54a3a; color: #fff; }
        .lib-empty { text-align: center; padding: 5rem 2rem; background: #fffdf9; border: 1px solid #e0d0bc; border-radius: 2px; }
        .lib-empty-ornament { font-family: 'Playfair Display', Georgia, serif; font-size: 4rem; color: #e0d0bc; line-height: 1; margin-bottom: 1.25rem; display: block; }
        .lib-empty-title { font-family: 'Playfair Display', Georgia, serif; font-size: 1.5rem; font-weight: 600; color: #2c1810; margin-bottom: 0.5rem; }
        .lib-empty-text { font-family: 'Crimson Pro', Georgia, serif; font-size: 1.05rem; font-style: italic; color: #9a8470; margin-bottom: 1.75rem; }
        .dark .lib-empty { background: #1e1812; border-color: rgba(138,102,64,0.25); }
        .dark .lib-empty-title { color: #e8d8c4; }
        .dark .lib-empty-text { color: #9a8878; }

        @keyframes lib-fadein { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: translateY(0); } }
        .lib-card:nth-child(1) { animation-delay: 0.04s; }
        .lib-card:nth-child(2) { animation-delay: 0.09s; }
        .lib-card:nth-child(3) { animation-delay: 0.14s; }
        .lib-card:nth-child(4) { animation-delay: 0.19s; }
        .lib-card:nth-child(5) { animation-delay: 0.24s; }
        .lib-card:nth-child(6) { animation-delay: 0.29s; }
        .lib-card:nth-child(n+7) { animation-delay: 0.32s; }
    </style>

    <div class="lib-page py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="lib-alert">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="lib-section-meta">
                <span class="lib-section-label">{{ $categories->count() }} categories in archive</span>
                <div class="lib-section-rule"></div>
            </div>

            @if($categories->count())
                <div class="lib-grid">
                    @foreach($categories as $index => $category)
                        <div class="lib-card">
                            <div class="lib-card-spine">
                                <p class="lib-card-meta">Shelf {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }} · Cat {{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}</p>
                                <h3 class="lib-card-title">{{ $category->name }}</h3>
                                <span class="lib-card-tag">classification</span>
                            </div>
                            <div class="lib-card-body">
                                <p class="lib-field-label">Catalogue name</p>
                                <p class="lib-field-value">{{ $category->name }}</p>
                                <p class="lib-field-label" style="margin-top:0.9rem;">Category number</p>
                                <p class="lib-field-value mono">#{{ str_pad($category->id, 4, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <div class="lib-card-divider"></div>
                            <div class="lib-card-actions">
                                <a href="{{ route('categories.edit', $category) }}" class="lib-btn lib-btn-edit">{{ __('Edit') }}</a>
                                <form method="POST" action="{{ route('categories.destroy', $category) }}" style="flex:1;" onsubmit="return confirm('Remove this classification from the archive?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="lib-btn lib-btn-delete" style="width:100%;">{{ __('Delete') }}</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="lib-empty">
                    <span class="lib-empty-ornament">&#x2767;</span>
                    <h3 class="lib-empty-title">{{ __('No records found in the archive') }}</h3>
                    <p class="lib-empty-text">{{ __('No classifications have been catalogued yet.') }}</p>
                    <a href="{{ route('categories.create') }}" class="lib-add-btn">{{ __('Add First Category') }}</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>