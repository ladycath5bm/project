<x-app-layout>
    @section('sidebar')
    <div class="min-h-screen px-4 py-4 rounded bg-gray-100 ">
        <div class="flex flex-wrap justify-center bg-white rounded-lg shadow-lg mb-4">
            <button class="font-bold flex-grow text-gray-900 rounded-lg shadow-lg bg-white text-lg h-12">Ecom</button>            
        </div>
        <nav class="flex flex-col bg-white w-48 max-h-screen tex-gray-900 rounded-lg shadow-lg">
        
            <div class="mt-2 mb-2 mr-2  max-h-screen">
                <ul class="ml-2">
                    @foreach ($categories as $category)
                        <li class="w-full py-2 text-black flex flex-row hover:text-white   hover:bg-orange-600  hover:font-bold rounded  ">
                            <span>
                                
                            </span>
                            <a href="{{ route('products.showbycategory', $category) }}">
                                <span class="ml-2">{{ $category->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
    @endsection
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4 mt-4 pb-4  bg-gray-100 rounded lg:rounded justify-between leading-normal">
       
        @forelse ($top as $product)
            <div>
                <div>
                    {{ $product }}
                </div>
            </div>
        @empty
            <div>
                <span>
                    Products not found
                </span>
            </div>
        @endforelse
        
    </div>
</x-app-layout>