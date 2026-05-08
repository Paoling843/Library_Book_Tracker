<x-guest-layout>
    <style>
        .lib-auth-title { font-family: 'Playfair Display', Georgia, serif; font-size: 1.4rem; font-weight: 600; color: #2c1810; }
        .lib-auth-subtitle { font-family: 'Crimson Pro', Georgia, serif; font-size: 0.95rem; font-style: italic; color: #8a7660; margin-top: 0.2rem; }
        .dark .lib-auth-title { color: #e8d8c4; }
        .dark .lib-auth-subtitle { color: #9a8878; }
        .lib-field-label { display:block; font-family: 'DM Mono', monospace; font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: #9a8470; margin-bottom: 0.4rem; }
        .dark .lib-field-label { color: #6a5a4a; }
        .lib-input {
            width: 100%; font-family: 'Crimson Pro', Georgia, serif; font-size: 1.05rem; background: #fffdf9; color: #2c1810;
            border: 1px solid #d4c4b0; border-radius: 2px; padding: 0.6rem 0.9rem; outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .lib-input:focus { border-color: #8a6640; box-shadow: 0 0 0 3px rgba(138,102,64,0.12); }
        .dark .lib-input { background: #1e1812; border-color: rgba(138,102,64,0.35); color: #e8d8c4; }
        .lib-error { margin-top: 0.35rem; font-family: 'DM Mono', monospace; font-size: 0.65rem; letter-spacing: 0.1em; text-transform: uppercase; color: #b54a3a; }
        .lib-link { font-family: 'Crimson Pro', Georgia, serif; font-size: 0.95rem; color: #8a6640; text-decoration: underline; text-underline-offset: 0.16em; }
        .lib-link:hover { color: #6b3d20; }
        .lib-btn {
            font-family: 'Crimson Pro', Georgia, serif; font-size: 0.95rem; font-weight: 500; letter-spacing: 0.04em; text-transform: uppercase;
            background: #2c1810; color: #f5ede0; border-radius: 2px; padding: 0.5rem 1.25rem; border: 1px solid #2c1810;
            transition: background 0.2s ease, box-shadow 0.2s ease;
        }
        .lib-btn:hover { background: #4a2c1a; box-shadow: 0 4px 16px rgba(44,24,16,0.18); }
        .lib-check { accent-color: #8a6640; }
        .lib-check-label { font-family: 'Crimson Pro', Georgia, serif; color: #5a4838; }
        .dark .lib-check-label { color: #9a8878; }
    </style>

    <div class="mb-5">
        <h1 class="lib-auth-title">{{ __('Enter the Archive') }}</h1>
        <p class="lib-auth-subtitle">{{ __('Sign in to continue your reading ledger') }}</p>
    </div>

    @if (session('status'))
        <div class="mb-4 px-4 py-3 border border-[#d4b896] border-l-4 border-l-[#8a6640] bg-[#fdf8f1] text-[#5a3e28] rounded-[2px]">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" class="lib-field-label">{{ __('Email') }}</label>
            <input id="email" class="lib-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email') <p class="lib-error">{{ $message }}</p> @enderror
        </div>

        <div class="mt-4">
            <label for="password" class="lib-field-label">{{ __('Password') }}</label>
            <input id="password" class="lib-input" type="password" name="password" required autocomplete="current-password" />
            @error('password') <p class="lib-error">{{ $message }}</p> @enderror
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="lib-check rounded border-[#d4c4b0]" name="remember">
                <span class="ms-2 text-sm lib-check-label">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="lib-link" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="lib-btn ms-3">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
