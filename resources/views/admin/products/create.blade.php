</div>
<form method="POST" action="{{ route('admin.products.store') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="name" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="code" value="{{ __('code') }}" />
                <x-jet-input id="code" class="block mt-1 w-full" type="code" name="code" required autocomplete="current-code" />
            </div>

            <div class="mt-4">
                <x-jet-label for="price" value="{{ __('price') }}" />
                <x-jet-input id="price" class="block mt-1 w-full" type="price" name="price" required autocomplete="current-price" />
            </div>

            <div class="mt-4">
                <x-jet-label for="stock" value="{{ __('stock') }}" />
                <x-jet-input id="stock" class="block mt-1 w-full" type="stock" name="stock" required autocomplete="current-stock" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
<div>