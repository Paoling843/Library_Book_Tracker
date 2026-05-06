<x-app-layout>
    <x-slot name="header">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Crimson+Pro:ital,wght@0,300;0,400;0,500;1,300;1,400&family=DM+Mono:wght@300;400&display=swap');

            .lib-header-wrap {
                font-family: 'Playfair Display', Georgia, serif;
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 1rem;
            }

            .lib-header-title {
                font-family: 'Playfair Display', Georgia, serif;
                font-size: 1.5rem;
                font-weight: 700;
                letter-spacing: -0.02em;
                color: #1a1208;
            }

            .dark .lib-header-title {
                color: #f5ede0;
            }

            .lib-header-subtitle {
                font-family: 'Crimson Pro', Georgia, serif;
                font-size: 0.875rem;
                font-style: italic;
                color: #8a7660;
                margin-top: 0.15rem;
                font-weight: 300;
                letter-spacing: 0.01em;
            }

            .dark .lib-header-subtitle {
                color: #a89880;
            }

            .lib-add-btn {
                font-family: 'Crimson Pro', Georgia, serif;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.5rem 1.25rem;
                background: #2c1810;
                color: #f5ede0;
                border-radius: 2px;
                font-size: 0.95rem;
                font-weight: 500;
                letter-spacing: 0.04em;
                text-transform: uppercase;
                transition: background 0.2s ease, box-shadow 0.2s ease;
                text-decoration: none;
                border: 1px solid #2c1810;
            }

            .lib-add-btn:hover {
                background: #4a2c1a;
                box-shadow: 0 4px 16px rgba(44,24,16,0.18);
            }

            .dark .lib-add-btn {
                background: #f5ede0;
                color: #2c1810;
                border-color: #f5ede0;
            }

            .dark .lib-add-btn:hover {
                background: #ffe8cc;
                box-shadow: 0 4px 16px rgba(245,237,224,0.12);
            }
        </style>

        <div class="lib-header-wrap">
            <div>
                <h2 class="lib-header-title">{{ __('Library Collection') }}</h2>
                <p class="lib-header-subtitle">{{ __('Browse the catalogue') }}</p>
            </div>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('books.create') }}" class="lib-add-btn">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        {{ __('Add Book') }}
                    </a>
                @endif
            @endauth
        </div>
    </x-slot>

    <style>
        /* ── Global library theme ── */
        .lib-page {
            font-family: 'Crimson Pro', Georgia, serif;
            background: #f9f4ee;
            min-height: 100vh;
        }

        .dark .lib-page {
            background: transparent;
        }

        /* ── Alert ── */
        .lib-alert {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            margin-bottom: 1.75rem;
            padding: 0.9rem 1.25rem;
            background: #fdf8f1;
            border: 1px solid #d4b896;
            border-left: 4px solid #8a6640;
            border-radius: 2px;
            font-family: 'Crimson Pro', Georgia, serif;
            font-size: 1.05rem;
            color: #5a3e28;
        }

        .dark .lib-alert {
            background: rgba(138,102,64,0.12);
            border-color: rgba(212,184,150,0.3);
            border-left-color: #c49a6c;
            color: #d4b896;
        }

        /* ── Decorative section label ── */
        .lib-section-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .lib-section-rule {
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, #c9b49a, transparent);
        }

        .dark .lib-section-rule {
            background: linear-gradient(to right, rgba(201,180,154,0.35), transparent);
        }

        .lib-section-label {
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            font-weight: 300;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #9a8470;
        }

        .dark .lib-section-label {
            color: #7a6a5a;
        }

        /* ── Book grid ── */
        .lib-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        /* ── Book card ── */
        .lib-card {
            background: #fffdf9;
            border: 1px solid #e0d0bc;
            border-radius: 3px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.22s ease, box-shadow 0.22s ease;
            position: relative;
        }

        .lib-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(to bottom, #8a6640, #c49a6c);
            opacity: 0;
            transition: opacity 0.22s ease;
        }

        .lib-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(100,70,40,0.12), 0 2px 6px rgba(100,70,40,0.06);
        }

        .lib-card:hover::before {
            opacity: 1;
        }

        .dark .lib-card {
            background: #1e1812;
            border-color: rgba(138,102,64,0.25);
        }

        .dark .lib-card:hover {
            box-shadow: 0 12px 32px rgba(0,0,0,0.4), 0 2px 6px rgba(0,0,0,0.2);
        }

        /* ── Card spine (top decorative bar) ── */
        .lib-card-spine {
            padding: 1.4rem 1.5rem 1.2rem;
            background: linear-gradient(135deg, #2c1810 0%, #4a2c1a 60%, #6b3d20 100%);
            position: relative;
            overflow: hidden;
        }

        .lib-card-spine::after {
            content: '';
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        .lib-card-number {
            font-family: 'DM Mono', monospace;
            font-size: 0.6rem;
            font-weight: 300;
            letter-spacing: 0.2em;
            color: rgba(245,237,224,0.45);
            text-transform: uppercase;
            margin-bottom: 0.6rem;
        }

        .lib-card-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: #f5ede0;
            line-height: 1.3;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .lib-card-category {
            display: inline-block;
            margin-top: 0.75rem;
            padding: 0.2rem 0.65rem;
            background: rgba(245,237,224,0.12);
            border: 1px solid rgba(245,237,224,0.2);
            border-radius: 1px;
            font-family: 'DM Mono', monospace;
            font-size: 0.6rem;
            font-weight: 300;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: rgba(245,237,224,0.7);
        }

        /* ── Card body ── */
        .lib-card-body {
            padding: 1.25rem 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .lib-field-label {
            font-family: 'DM Mono', monospace;
            font-size: 0.6rem;
            font-weight: 300;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #9a8470;
            margin-bottom: 0.15rem;
        }

        .dark .lib-field-label {
            color: #6a5a4a;
        }

        .lib-field-value {
            font-family: 'Crimson Pro', Georgia, serif;
            font-size: 1.05rem;
            font-weight: 500;
            color: #2c1810;
            line-height: 1.35;
        }

        .dark .lib-field-value {
            color: #e8d8c4;
        }

        .lib-field-value.mono {
            font-family: 'DM Mono', monospace;
            font-size: 0.8rem;
            font-weight: 300;
            letter-spacing: 0.05em;
            color: #6a5040;
        }

        .dark .lib-field-value.mono {
            color: #a08060;
        }

        .lib-field-value.desc {
            font-size: 0.95rem;
            font-weight: 300;
            font-style: italic;
            color: #5a4838;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.55;
        }

        .dark .lib-field-value.desc {
            color: #9a8878;
        }

        /* ── Divider ── */
        .lib-card-divider {
            height: 1px;
            background: linear-gradient(to right, #e0d0bc, transparent);
            margin: 0 1.5rem;
        }

        .dark .lib-card-divider {
            background: linear-gradient(to right, rgba(138,102,64,0.2), transparent);
        }

        /* ── Card footer actions ── */
        .lib-card-actions {
            padding: 1rem 1.5rem;
            display: flex;
            gap: 0.75rem;
        }

        .lib-btn {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.55rem 1rem;
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            font-weight: 400;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            border-radius: 2px;
            border: 1px solid transparent;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.18s ease;
        }

        .lib-btn-edit {
            background: transparent;
            border-color: #8a6640;
            color: #8a6640;
        }

        .lib-btn-edit:hover {
            background: #8a6640;
            color: #f5ede0;
        }

        .dark .lib-btn-edit {
            border-color: #c49a6c;
            color: #c49a6c;
        }

        .dark .lib-btn-edit:hover {
            background: #c49a6c;
            color: #1e1812;
        }

        .lib-btn-delete {
            background: transparent;
            border-color: #b54a3a;
            color: #b54a3a;
        }

        .lib-btn-delete:hover {
            background: #b54a3a;
            color: #fff;
        }

        .dark .lib-btn-delete {
            border-color: #c96050;
            color: #c96050;
        }

        .dark .lib-btn-delete:hover {
            background: #c96050;
            color: #fff;
        }

        .lib-btn form {
            margin: 0;
            padding: 0;
        }

        /* ── Empty state ── */
        .lib-empty {
            text-align: center;
            padding: 5rem 2rem;
            background: #fffdf9;
            border: 1px solid #e0d0bc;
            border-radius: 3px;
        }

        .dark .lib-empty {
            background: #1e1812;
            border-color: rgba(138,102,64,0.2);
        }

        .lib-empty-ornament {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 4rem;
            color: #e0d0bc;
            line-height: 1;
            margin-bottom: 1.25rem;
            display: block;
        }

        .dark .lib-empty-ornament {
            color: rgba(138,102,64,0.3);
        }

        .lib-empty-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c1810;
            margin-bottom: 0.5rem;
        }

        .dark .lib-empty-title {
            color: #e8d8c4;
        }

        .lib-empty-text {
            font-family: 'Crimson Pro', Georgia, serif;
            font-size: 1.05rem;
            font-style: italic;
            color: #9a8470;
            margin-bottom: 1.75rem;
        }

        /* ── Card fade-in animation ── */
        @keyframes lib-fadein {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .lib-card {
            animation: lib-fadein 0.38s ease both;
        }

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

            {{-- Flash message --}}
            @if (session('success'))
                <div class="lib-alert">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Section rule --}}
            <div class="lib-section-meta">
                <span class="lib-section-label">{{ $books->count() }} {{ Str::plural('volume', $books->count()) }} in catalogue</span>
                <div class="lib-section-rule"></div>
            </div>

            {{-- Books grid --}}
            @if($books->count() > 0)
                <div class="lib-grid">
                    @foreach($books as $index => $book)
                        <div class="lib-card">

                            {{-- Spine --}}
                            <div class="lib-card-spine">
                                <div class="lib-card-number">
                                    Vol. {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                                    @if($book->isbn) &nbsp;·&nbsp; {{ $book->isbn }} @endif
                                </div>
                                <h3 class="lib-card-title" title="{{ $book->title }}">{{ $book->title }}</h3>
                                @if($book->category)
                                    <span class="lib-card-category">{{ $book->category->name }}</span>
                                @endif
                            </div>

                            {{-- Body --}}
                            <div class="lib-card-body">
                                <div>
                                    <p class="lib-field-label">{{ __('Author') }}</p>
                                    <p class="lib-field-value">{{ $book->author }}</p>
                                </div>

                                @if($book->published_date)
                                    <div>
                                        <p class="lib-field-label">{{ __('Published') }}</p>
                                        <p class="lib-field-value mono">{{ $book->published_date }}</p>
                                    </div>
                                @endif

                                @if($book->description)
                                    <div>
                                        <p class="lib-field-label">{{ __('Description') }}</p>
                                        <p class="lib-field-value desc">{{ $book->description }}</p>
                                    </div>
                                @endif
                            </div>

                            {{-- Actions --}}
                            @auth
                                @if(auth()->user()->isAdmin())
                                    <div class="lib-card-divider"></div>
                                    <div class="lib-card-actions">
                                        <a href="{{ route('books.edit', $book->id) }}" class="lib-btn lib-btn-edit">
                                            <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            {{ __('Edit') }}
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('books.destroy', $book->id) }}"
                                            style="flex:1; display:contents;"
                                            onsubmit="return confirm('Remove \'{{ addslashes($book->title) }}\' from the catalogue?');"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="lib-btn lib-btn-delete">
                                                <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                {{ __('Remove') }}
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth

                        </div>
                    @endforeach
                </div>

            @else
                {{-- Empty state --}}
                <div class="lib-empty">
                    <span class="lib-empty-ornament">&#x2767;</span>
                    <h3 class="lib-empty-title">{{ __('The shelves are bare') }}</h3>
                    <p class="lib-empty-text">{{ __('No volumes have been catalogued yet.') }}</p>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('books.create') }}" class="lib-add-btn" style="display:inline-flex;">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                                {{ __('Add First Book') }}
                            </a>
                        @endif
                    @endauth
                </div>
            @endif

        </div>
    </div>
</x-app-layout>