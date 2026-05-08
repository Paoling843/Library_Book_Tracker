<x-app-layout>
    <x-slot name="header">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Crimson+Pro:ital,wght@0,300;0,400;0,500;1,300;1,400&family=DM+Mono:wght@300;400&display=swap');

            .lib-header-title { font-family: 'Playfair Display', Georgia, serif; font-size: 1.5rem; font-weight: 600; color: #2c1810; }
            .lib-header-subtitle { font-family: 'Crimson Pro', Georgia, serif; font-size: 0.875rem; font-style: italic; color: #8a7660; margin-top: 0.2rem; }
            .dark .lib-header-title { color: #e8d8c4; }
            .dark .lib-header-subtitle { color: #9a8878; }
        </style>
        <div>
            <h2 class="lib-header-title">{{ __('Edit Category') }}</h2>
            <p class="lib-header-subtitle">{{ __('Refine this classification in the archive') }}</p>
        </div>
    </x-slot>

    <style>
        .lib-page { font-family: 'Crimson Pro', Georgia, serif; background: #f9f4ee; min-height: 100vh; }
        .dark .lib-page { background: transparent; }
        .lib-form-shell { max-width: 38rem; margin: 0 auto; }
        .lib-form-card { border: 1px solid #e0d0bc; border-radius: 2px; background: #fffdf9; overflow: hidden; animation: lib-fadein 0.42s ease both; }
        .dark .lib-form-card { background: #1e1812; border-color: rgba(138,102,64,0.25); }
        .lib-form-head { padding: 1.2rem 1.5rem; background: linear-gradient(135deg, #2c1810 0%, #4a2c1a 60%, #6b3d20 100%); color: #f5ede0; }
        .lib-form-head p { font-family: 'DM Mono', monospace; font-size: 0.65rem; letter-spacing: 0.18em; text-transform: uppercase; color: rgba(245,237,224,0.7); margin-bottom: 0.45rem; }
        .lib-form-head h3 { font-family: 'Playfair Display', Georgia, serif; font-size: 1.35rem; font-weight: 600; margin: 0; }
        .lib-form-body { padding: 1.5rem; }
        .lib-field-label { display: block; font-family: 'DM Mono', monospace; font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: #9a8470; margin-bottom: 0.4rem; }
        .lib-input { width: 100%; font-family: 'Crimson Pro', Georgia, serif; font-size: 1.05rem; background: #fffdf9; border: 1px solid #d4c4b0; border-radius: 2px; padding: 0.6rem 0.9rem; color: #2c1810; }
        .lib-input:focus { border-color: #8a6640; box-shadow: 0 0 0 3px rgba(138,102,64,0.12); outline: none; }
        .dark .lib-input { background: #1e1812; border-color: rgba(138,102,64,0.35); color: #e8d8c4; }
        .lib-form-footer { display: flex; justify-content: flex-end; gap: 0.75rem; padding: 1rem 1.5rem; border-top: 1px solid #e0d0bc; background: #fffaf3; }
        .dark .lib-form-footer { border-top-color: rgba(138,102,64,0.25); background: #1a140f; }
        .lib-btn { border-radius: 2px; padding: 0.55rem 1rem; text-transform: uppercase; text-decoration: none; transition: all 0.18s ease; }
        .lib-btn-cancel { font-family: 'DM Mono', monospace; font-size: 0.65rem; letter-spacing: 0.12em; border: 1px solid #8a6640; color: #8a6640; background: transparent; }
        .lib-btn-cancel:hover { background: #8a6640; color: #f5ede0; }
        .lib-btn-primary { font-family: 'Crimson Pro', Georgia, serif; font-size: 0.95rem; font-weight: 500; letter-spacing: 0.04em; border: 1px solid #2c1810; background: #2c1810; color: #f5ede0; padding: 0.5rem 1.25rem; }
        .lib-btn-primary:hover { background: #4a2c1a; box-shadow: 0 4px 16px rgba(44,24,16,0.18); }
        .lib-input-error { margin-top: 0.35rem; font-family: 'DM Mono', monospace; font-size: 0.65rem; letter-spacing: 0.1em; text-transform: uppercase; color: #b54a3a; }
        @keyframes lib-fadein { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: translateY(0); } }
    </style>

    <div class="lib-page py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lib-form-shell">
                <form method="POST" action="{{ route('categories.update', $category) }}" class="lib-form-card">
                    @csrf
                    @method('PUT')
                    <div class="lib-form-head">
                        <p>{{ __('Catalogued classification') }}</p>
                        <h3>{{ __('Edit Category') }}</h3>
                    </div>
                    <div class="lib-form-body">
                        <label for="name" class="lib-field-label">{{ __('Category Name') }}</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $category->name) }}" class="lib-input" required autofocus>
                        @error('name') <p class="lib-input-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="lib-form-footer">
                        <a href="{{ route('categories.index') }}" class="lib-btn lib-btn-cancel">{{ __('Cancel') }}</a>
                        <button type="submit" class="lib-btn lib-btn-primary">{{ __('Save Revisions') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>