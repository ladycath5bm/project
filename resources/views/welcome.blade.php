<x-app-layout>
    <!--<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            { __('Dashboard') }}
        </h2>
    </x-slot>-->

    <div class="py-8 px-20">
        @foreach ($categories as $category)
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-6 mb-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-6 sm:px-10 bg-white border-b border-gray-200">
                
                    <div class="py-2 text-orange-500 text-2xl hover:text-gray-400">
                        <a href="{{ route('products.showbycategory', $category) }}">{{ $category->name }}</a>
                    </div>
                
                    <div class="py-2 text-gray-500 flex items-center">
                        <div>
                            <img class=" rounded-md h-100 w-full" src="https://thumbs.dreamstime.com/b/foto-horizontal-de-computadora-port%C3%A1til-taza-caf%C3%A9-y-planta-en-escritorio-madera-la-oficina-mock-up-210524413.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
