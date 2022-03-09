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
        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
        <a class="text-sm mt-1 text-gray-400" href="{{ route('products.index') }}">{{ __('Home ') }}></a>
        <a class="text-sm mt-1 text-gray-400" href="{{ route('products.showbycategory', $product->category) }}">{{ $product->category->name }}</a>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
            
            <div class="lg:col-span-2">
                
                <div class="max-w-sm h-full lg:max-w-full mt-2">
                    
                    <div class="border border-gray-400 lg:border-gray-400 bg-white rounded lg:rounded p-4 flex flex-col justify-between leading-normal">
                      
                      <div class="flex items-center mb-4 mt-4">
                        <img class="h-80 sm:h-20 object-cover object-center mx-4" src="@if(isset($product->images->first()->url)) {{ Storage::url($product->images->first()->url) }} @else http://wallup.net/wp-content/uploads/2016/03/10/322474-sunlight-winter-landscape-snow.jpg @endif" alt="">
                        
                        <div class="mb-6 mx-4 mt-4">
                            <p class="text-sm text-gray-600 flex items-center mb-2">
                
                            </p>
                            <div class="text-sm mx-4 mt-4">
                                <div class="text-gray-900 font-bold text-2xl mb-2">{{ $product->name }}</div>
                            
                                <p class="text-gray-700 text-2xl mb-4"><strong>$ </strong>{{ $product->price }}</p>
                                <p class="text-gray-900 leading-none"><strong>Code: </strong>{{ $product->code }}</p>
                                <p class="text-gray-600 mb-4"><strong>Stock: </strong>{{ $product->stock }}</p>

                                <a href=# class="btn-custom btn-primary rounded justify-center text-white text-xl">Buy</a>
                                
                            </div>
                        </div>
                        
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <aside class="col-span-1 justify-items-center mt-4 mx-2">
            <h1 class="text-2xl font-bold text-gray-600 mb-4 mt-4">
                Products similar in {{ $product->category->name }}
            </h1>
    
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-2 mt-4 mx-4 ">
                @foreach ($similarProductsByCategory as $similar) 
                    
                    <div class="col-span-1 lg:col-span-1 xl:col-span-1 flex-col">
            
                        <div class="max-w-sm mt-2 flex">
                            
                            <div class="border border-gray-400 bg-white rounded lg:rounded p-2 flex-col">
                                
                                <div class="flex items-center mb-2 rounded">
                                    <img class="w-36 object-cover object-center rounded" src="@if(isset($similar->images->first()->url)) {{ Storage::url($similar->images->first()->url) }} @else http://wallup.net/wp-content/uploads/2016/03/10/322474-sunlight-winter-landscape-snow.jpg @endif" alt="">
        
                                </div>
                                <div class="mx-2">
                                <p class="text-sm text-gray-600 flex items-center">
                    
                                </p>
                                <div class="text-sm mx-4">
                                    <div class="text-gray-900 font-bold text-lg">
                                            <a href="{{ route('products.show', $similar) }}">{{ $similar->name }}</a>
                                    </div>
                            
                                    <p class="text-gray-700 text-lg"><strong>$ </strong>{{ $similar->price }}</p>
                                    <p class="text-gray-600 "><strong>Stock: </strong>{{ $similar->stock }}</p>
                                        
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>         
                @endforeach
            </div>
        </aside>
    </div>
</x-app-layout>