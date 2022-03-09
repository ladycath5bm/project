<x-app-layout>
    <!--<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            { __('Dashboard') }}
        </h2>
    </x-slot>-->

    <div class="py-8  px-6">
        @foreach ($categories as $category)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6 mb-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <span class="font-bold text-2xl text-gray-900"><a href="{{ route('products.showbycategory', $category) }}">{{ $category->name }}</a></span>
                    </div>
                
                    <div class="mt-2 text-2xl">
                        <a href="{{ route('products.showbycategory', $category) }}">{{ $category->name }}</a>
                    </div>
                
                    <div class="mt-6 text-gray-500">
                        Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is designed
                        to help you build your application using a development environment that is simple, powerful, and enjoyable. We believe
                        you should love expressing your creativity through programming, so we have spent time carefully crafting the Laravel
                        ecosystem to be a breath of fresh air. We hope you love it.
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
