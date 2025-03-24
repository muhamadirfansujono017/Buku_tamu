<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">

        <form method="POST" action="{{ route('register') }}" class="bg-white p-6 rounded-lg shadow-md w-96">
            @csrf

            <h2 class="text-2xl font-bold text-center mb-4">{{ __('Register') }}</h2>

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full border border-gray-300 rounded-md p-2" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full border border-gray-300 rounded-md p-2" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full border border-gray-300 rounded-md p-2"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full border border-gray-300 rounded-md p-2"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Role Selection -->
            <div class="mb-5 mt-4">
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                <select class="js-example-placeholder-single js-states form-control w-full m-6 p-3 border border-gray-300 rounded-md" name="role" data-placeholder="Pilih role" required>
                    <option value="">Pilih...</option>
                    <option value="A">ADMIN</option>
                    <option value="U">TAMU</option>
                </select>
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button>
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>