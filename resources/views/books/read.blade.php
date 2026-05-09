<x-app-layout>
    <x-slot name="header">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Crimson+Pro:ital,wght@0,300;0,400;0,500;1,300;1,400&family=DM+Mono:wght@300;400&display=swap');

            .lib-header-wrap {
                display: flex;
                padding-inline: 150px;
                justify-content: space-between;
                align-items: center;
                background: #f9f4ee;
                gap: 1rem;
            }

            .lib-header-title {
                font-family: 'Playfair Display', Georgia, serif;
                font-size: 1.5rem;
                font-weight: 600;
                color: #2c1810;
            }

            .lib-header-subtitle {
                font-family: 'Crimson Pro', Georgia, serif;
                font-size: 0.875rem;
                font-style: italic;
                color: #8a7660;
                margin-top: 0.2rem;
            }

            .dark .lib-header-title { color: #e8d8c4; }
            .dark .lib-header-subtitle { color: #9a8878; }
        </style>
        <div class="lib-header-wrap">
            <div>
                <h2 class="lib-header-title">{{ __('Reading Room') }}</h2>
                <p class="lib-header-subtitle">{{ __('Settle in and turn the next page') }}</p>
            </div>
        </div>
    </x-slot>

    <style>
        .lib-page {
            font-family: 'Crimson Pro', Georgia, serif;
            background: #f9f4ee;
            min-height: 100vh;
        }

        .dark .lib-page { background: transparent; }

        .lib-read-card {
            background: #fffdf9;
            border: 1px solid #e0d0bc;
            border-radius: 2px;
            overflow: hidden;
            box-shadow: 0 10px 26px rgba(100,70,40,0.08);
            animation: lib-fadein 0.42s ease both;
        }

        .dark .lib-read-card {
            background: #1e1812;
            border-color: rgba(138,102,64,0.25);
            box-shadow: 0 10px 28px rgba(0,0,0,0.35);
        }

        .lib-read-spine {
            padding: 1.4rem 1.5rem 1.2rem;
            background: linear-gradient(135deg, #2c1810 0%, #4a2c1a 60%, #6b3d20 100%);
            position: relative;
            overflow: hidden;
        }

        .lib-read-spine::after {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        .lib-meta-line {
            position: relative;
            z-index: 1;
            font-family: 'DM Mono', monospace;
            font-size: 0.6rem;
            font-weight: 300;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(245,237,224,0.55);
            margin-bottom: 0.5rem;
        }

        .lib-title {
            position: relative;
            z-index: 1;
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.5rem;
            line-height: 1.25;
            font-weight: 700;
            color: #f5ede0;
            margin: 0;
        }

        .lib-tag {
            position: relative;
            z-index: 1;
            display: inline-block;
            margin-top: 0.75rem;
            padding: 0.2rem 0.65rem;
            border: 1px solid rgba(245,237,224,0.2);
            border-radius: 2px;
            font-family: 'DM Mono', monospace;
            font-size: 0.6rem;
            font-weight: 300;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: rgba(245,237,224,0.78);
        }

        .lib-read-head {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 1.4rem;
            border-bottom: 1px solid #e0d0bc;
        }

        .dark .lib-read-head {
            border-bottom-color: rgba(138,102,64,0.25);
        }

        .lib-book-image {
            width: 100%;
            border-radius: 2px;
            border: 1px solid #e0d0bc;
            box-shadow: 0 8px 22px rgba(100,70,40,0.12);
            object-fit: cover;
        }

        .dark .lib-book-image {
            border-color: rgba(138,102,64,0.35);
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

        .lib-field-value {
            font-family: 'Crimson Pro', Georgia, serif;
            font-size: 1.1rem;
            font-weight: 500;
            color: #2c1810;
        }

        .lib-field-value.desc {
            margin-top: 0.9rem;
            font-size: 1rem;
            font-weight: 300;
            font-style: italic;
            line-height: 1.55;
            color: #5a4838;
        }

        .lib-status {
            display: inline-block;
            padding: 0.3rem 0.7rem;
            border-radius: 2px;
            font-size: 0.7rem;
            font-family: 'DM Mono', monospace;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border: 1px solid;
        }

        .lib-status-available {
            color: #2e7d32;
            border-color: #2e7d32;
            background: rgba(46,125,50,0.08);
        }

        .lib-status-borrowed {
            color: #b54a3a;
            border-color: #b54a3a;
            background: rgba(181,74,58,0.08);
        }

        .lib-status-reserved {
            color: #8a6640;
            border-color: #8a6640;
            background: rgba(138,102,64,0.08);
        }

        .lib-status-maintenance {
            color: #7b5ea7;
            border-color: #7b5ea7;
            background: rgba(123,94,167,0.08);
        }

        .lib-status-lost {
            color: #444;
            border-color: #444;
            background: rgba(68,68,68,0.08);
        }

        .dark .lib-field-label { color: #6a5a4a; }
        .dark .lib-field-value { color: #e8d8c4; }
        .dark .lib-field-value.desc { color: #9a8878; }

        .lib-read-body {
            width: 100%;
            padding: 2rem 2.5rem 2.5rem;
        }

        .lib-body-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: #2c1810;
            margin-bottom: 0.8rem;
        }

        .dark .lib-body-title { color: #e8d8c4; }

        .lib-body-divider {
            height: 1px;
            margin-bottom: 1rem;
            background: linear-gradient(to right, #e0d0bc, transparent);
        }

        .dark .lib-body-divider {
            background: linear-gradient(to right, rgba(138,102,64,0.25), transparent);
        }

        .lib-content {
            width: 100%;
            max-width: 850px;

            margin: 0 auto;

            padding: 1.5rem 1rem;

            color: #2c1810;
            font-family: 'Crimson Pro', Georgia, serif;
            font-size: 1.08rem;
            line-height: 1;

            text-align: justify;
            text-justify: inter-word;

            white-space: pre-wrap;
            word-break: break-word;
            overflow-wrap: break-word;

            hyphens: auto;
        }

        .dark .lib-content { color: #e8d8c4; }

        @keyframes lib-fadein {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {

            .lib-read-head {
                grid-template-columns: 1fr;
            }

            .lib-book-image {
                max-height: 360px;
            }

            .lib-read-body {
                padding: 1.4rem 1.2rem 1.6rem;
            }

            .lib-content {
                font-size: 1rem;
                line-height: 1.85;
            }
        }
    </style>

    <div class="lib-page py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lib-read-card">
                <div class="lib-read-spine">
                    <p class="lib-meta-line">
                        Vol. {{ str_pad($book->id, 3, '0', STR_PAD_LEFT) }}
                        @if($book->isbn) &nbsp;·&nbsp; {{ $book->isbn }} @endif
                    </p>
                    <h1 class="lib-title">{{ $book->title }}</h1>
                    @if($book->category)
                        <span class="lib-tag">{{ $book->category->name }}</span>
                    @endif
                </div>

                <div class="lib-read-head">
                    <div>
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="lib-book-image">
                        @endif
                    </div>
                    <div>
                        <div>
                            <p class="lib-field-label">{{ __('Author') }}</p>
                            <p class="lib-field-value">{{ $book->author }}</p>
                        </div>
                        @if($book->status)
                            <div>
                                <p class="lib-field-label">{{ __('Status') }}</p>
                                <span class="lib-status lib-status-{{ $book->status }}">{{ ucfirst($book->status) }}</span>
                            </div>
                        @endif
                        @if($book->description)
                            <div>
                                <p class="lib-field-label" style="margin-top: 0.9rem;">{{ __('Description') }}</p>
                                <p class="lib-field-value desc">{{ $book->description }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="lib-read-body">
                    <h2 class="lib-body-title">{{ __('Read Book') }}</h2>
                    <div class="lib-body-divider"></div>
                    <div class="lib-content">
                        {!! nl2br(e($book->content)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>