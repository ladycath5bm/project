<x-app-layout>
    <div class="mt-4">
        @foreach ($categories as $category)
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-2 mb-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-2 sm:px-8 bg-white border-b border-gray-200">
                
                    <div class="py-1 text-orange-500 text-2xl hover:text-gray-400">
                        <a href="{{ route('products.showbycategory', $category) }}">{{ $category->name }}</a>
                    </div>
                
                    <div class="py-1 text-gray-500 flex items-center mb-2">
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
