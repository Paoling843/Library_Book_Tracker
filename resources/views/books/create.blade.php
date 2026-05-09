<x-app-layout>
    <x-slot name="header">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Crimson+Pro:ital,wght@0,300;0,400;0,500;1,300;1,400&family=DM+Mono:wght@300;400&display=swap');

            .lib-header-wrap {
                display: flex;
                align-items: center;
                background: #f9f4ee;
                padding-inline: 380px;
                gap: 1rem;
            }

            .lib-header-title {
                font-family: 'Playfair Display', Georgia, serif;
                font-size: 1.5rem;
                font-weight: 600;
                color: #2c1810;
                letter-spacing: -0.01em;
            }

            .lib-header-subtitle {
                font-family: 'Crimson Pro', Georgia, serif;
                font-size: 0.875rem;
                font-style: italic;
                font-weight: 300;
                color: #8a7660;
                margin-top: 0.2rem;
            }

            .dark .lib-header-title {
                color: #e8d8c4;
            }

            .dark .lib-header-subtitle {
                color: #9a8878;
            }
        </style>
        <div class="lib-header-wrap">
            <div>
                <h2 class="lib-header-title">{{ __('Add New Volume') }}</h2>
                <p class="lib-header-subtitle">{{ __('Catalogue a new work for the collection') }}</p>
            </div>
        </div>
    </x-slot>

    <style>
        .lib-page {
            font-family: 'Crimson Pro', Georgia, serif;
            background: #f9f4ee;
            min-height: 100vh;
        }

        .dark .lib-page {
            background: transparent;
        }

        .lib-form-shell {
            max-width: 48rem;
            margin: 0 auto;
        }

        .lib-alert-danger {
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            margin-bottom: 1.25rem;
            padding: 0.9rem 1.25rem;
            background: #fdf8f1;
            border: 1px solid #d4b896;
            border-left: 4px solid #b54a3a;
            border-radius: 2px;
            font-family: 'Crimson Pro', Georgia, serif;
            font-size: 1rem;
            color: #5a3e28;
        }

        .lib-alert-danger ul {
            margin: 0.35rem 0 0;
            padding-left: 1rem;
        }

        .dark .lib-alert-danger {
            background: rgba(181,74,58,0.12);
            border-color: rgba(212,184,150,0.3);
            color: #e8d8c4;
        }

        .lib-form-card {
            border: 1px solid #e0d0bc;
            border-radius: 2px;
            background: #fffdf9;
            overflow: hidden;
            box-shadow: 0 10px 26px rgba(100,70,40,0.08);
            animation: lib-fadein 0.42s ease both;
        }

        .dark .lib-form-card {
            background: #1e1812;
            border-color: rgba(138,102,64,0.25);
            box-shadow: 0 10px 28px rgba(0,0,0,0.35);
        }

        .lib-form-head {
            padding: 1.2rem 1.5rem;
            background: linear-gradient(135deg, #2c1810 0%, #4a2c1a 60%, #6b3d20 100%);
            position: relative;
            color: #f5ede0;
        }

        .lib-form-head::after {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        .lib-form-head-meta {
            position: relative;
            z-index: 1;
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            font-weight: 300;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: rgba(245,237,224,0.7);
            margin-bottom: 0.5rem;
        }

        .lib-form-head-title {
            position: relative;
            z-index: 1;
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.35rem;
            font-weight: 600;
            margin: 0;
        }

        .lib-form-body {
            padding: 1.5rem;
            display: grid;
            gap: 1.5rem;
        }

        .lib-field-label {
            display: block;
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #9a8470;
            margin-bottom: 0.4rem;
        }

        .dark .lib-field-label {
            color: #6a5a4a;
        }

        .lib-input,
        .lib-select,
        .lib-textarea {
            width: 100%;
            font-family: 'Crimson Pro', Georgia, serif;
            font-size: 1.05rem;
            background: #fffdf9;
            border: 1px solid #d4c4b0;
            border-radius: 2px;
            padding: 0.6rem 0.9rem;
            color: #2c1810;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .dark .lib-input,
        .dark .lib-select,
        .dark .lib-textarea {
            background: #1e1812;
            border-color: rgba(138,102,64,0.35);
            color: #e8d8c4;
        }

        .lib-input:focus,
        .lib-select:focus,
        .lib-textarea:focus {
            border-color: #8a6640;
            box-shadow: 0 0 0 3px rgba(138,102,64,0.12);
        }

        .lib-textarea {
            min-height: 8.5rem;
            resize: vertical;
        }

        .lib-input-error {
            margin-top: 0.35rem;
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #b54a3a;
        }

        .lib-form-footer {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border-top: 1px solid #e0d0bc;
            background: #fffaf3;
        }

        .dark .lib-form-footer {
            border-top-color: rgba(138,102,64,0.25);
            background: #1a140f;
        }

        .lib-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 2px;
            padding: 0.55rem 1rem;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.18s ease;
            cursor: pointer;
        }

        .lib-btn-cancel {
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            font-weight: 400;
            letter-spacing: 0.12em;
            border: 1px solid #8a6640;
            color: #8a6640;
            background: transparent;
        }

        .lib-btn-cancel:hover {
            background: #8a6640;
            color: #f5ede0;
        }

        .lib-btn-primary {
            font-family: 'Crimson Pro', Georgia, serif;
            font-size: 0.95rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            border: 1px solid #2c1810;
            background: #2c1810;
            color: #f5ede0;
            padding: 0.5rem 1.25rem;
        }

        .lib-btn-primary:hover {
            background: #4a2c1a;
            box-shadow: 0 4px 16px rgba(44,24,16,0.18);
        }

        .dark .lib-btn-cancel {
            border-color: #c49a6c;
            color: #c49a6c;
        }

        .dark .lib-btn-cancel:hover {
            background: #c49a6c;
            color: #1e1812;
        }

        .dark .lib-btn-primary {
            border-color: #c49a6c;
            background: #c49a6c;
            color: #1e1812;
        }

        .dark .lib-btn-primary:hover {
            background: #d8ae82;
            box-shadow: 0 4px 16px rgba(196,154,108,0.22);
        }

        @keyframes lib-fadein {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div class="lib-page py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lib-form-shell">
                @if ($errors->any())
                    <div class="lib-alert-danger">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M18 10A8 8 0 114 4.5L10 10l6-5.5A8 8 0 0118 10zM9 9V5h2v4H9zm0 2h2v4H9v-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p>{{ __('Please amend the following entries:') }}</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('books.store') }}" class="lib-form-card" enctype="multipart/form-data">
                    @csrf
                    <div class="lib-form-head">
                        <p class="lib-form-head-meta">{{ __('New accession') }}</p>
                        <h3 class="lib-form-head-title">{{ __('Add New Volume') }}</h3>
                    </div>

                    <div class="lib-form-body">
                        <div>
                            <label for="title" class="lib-field-label">{{ __('Book Title') }}</label>
                            <input id="title" name="title" type="text" class="lib-input" value="{{ old('title') }}"  autofocus>
                            @error('title') <p class="lib-input-error">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="author" class="lib-field-label">{{ __('Author') }}</label>
                            <input id="author" name="author" type="text" class="lib-input" value="{{ old('author') }}" >
                            @error('author') <p class="lib-input-error">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="category_id" class="lib-field-label">{{ __('Category') }}</label>
                            <select id="category_id" name="category_id" class="lib-select" >
                                <option value="">{{ __('Select a classification') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="lib-input-error">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="isbn" class="lib-field-label">{{ __('ISBN') }}</label>
                            <input id="isbn" name="isbn" type="text" class="lib-input" value="{{ old('isbn') }}"
                            inputmode="numeric" placeholder="xxx-xxxxxxxxxx" oninput="this.value = this.value.replace(/[^0-9-]g,'')"
                            >
                            @error('isbn') <p class="lib-input-error">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="published_date" class="lib-field-label">{{ __('Published Date') }}</label>
                            <input id="published_date" name="published_date" type="date" class="lib-input" max= "{{ date('m-d-Y') }}"value="{{ old('published_date') }}">
                            @error('published_date') <p class="lib-input-error">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="image" class="lib-field-label">{{ __('Book Image') }}</label>
                            <input id="image" name="image" type="file" class="lib-input" accept="image/*">
                            @error('image') <p class="lib-input-error">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="description" class="lib-field-label">{{ __('Description') }}</label>
                            <textarea id="description" name="description" class="lib-textarea">{{ old('description') }}</textarea>
                            @error('description') <p class="lib-input-error">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="content" class="lib-field-label">{{ __('Content') }}</label>
                            <textarea name="content" rows="12" class="lib-input">{{ old('content') }}</textarea>
                            @error('content') <p class="lib-input-error">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for='status' class="lib-field-label">{{ __('Book Status') }}</label>
                            <select name="status" id="status" class="lib-input">
                                <option value="available">Available</option>
                                <option value="borrowed">Borrowed</option>
                                <option value="reserved">Reserved</option>
                                <option value="maintenance">Maintenance</option>
                                <option value="lost">Lost</option>
                            </select>
                        </div>
                    </div>

                    <div class="lib-form-footer">
                        <a href="{{ route('books.index') }}" class="lib-btn lib-btn-cancel">{{ __('Cancel') }}</a>
                        <button type="submit" class="lib-btn lib-btn-primary">{{ __('Add Volume') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
