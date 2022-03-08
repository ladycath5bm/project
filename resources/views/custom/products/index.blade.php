<x-app-layout>
    @section('sidebar')
        @foreach ($categories as $category)
            <li class="w-full py-2 text-black flex flex-grow  border-black hover:text-white   hover:bg-gray-700  hover:font-bold rounded  ">
                <span>
                    
                </span>
                <a href="{{ route('products.showbycategory', $category) }}">
                    <span class="ml-2">{{ $category->name }}</span>
                </a>
            </li>
        @endforeach
    @endsection
            
    <div class="card flex">
        <div class="card-body flex ">
            <div class="max-w-3xl md:px-4 flex-grow ">
                <div class="mx-4">
                    
                    <!--<input wiremodel="search" class=" rounded form-control-lg mt-2 mx-6 px-6" placeholder="Search">-->
            
                </div>
                
                @if($products)
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-4 mt-4">
                    
                        @foreach ($products as $product)
                            <div class="col-span-1 lg:col-span-1 xl:col-span-1">
                                <div class="max-w-full h-full lg:max-w-full">
                                    
                                    <div class=" bg-white rounded lg:rounded p-4 flex flex-col shadow-md justify-between leading-normal">
                                        
                                        <div class="flex justify-center mb-2 mt-2 rounded">
                                            <img class="w-80 object-cover justify-center object-center rounded flex-col" src="@if(isset($product->images->first()->url)) {{ Storage::url($product->images->first()->url) }} @else http://wallup.net/wp-content/uploads/2016/03/10/322474-sunlight-winter-landscape-snow.jpg @endif" alt="">
            
                                        </div>
                                        <div class="mb-2 mx-2">
                                            <p class="text-sm text-gray-600 flex items-center mb-2">
                                
                                            </p>
                                            <div class="text-sm mx-2">
                                                <div class="text-gray-900 font-bold text-2xl">
                                                        <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                                </div>
                                            
                                                    <p class="text-gray-700 text-xl mb-4"><strong>$ </strong>{{ $product->price }}</p>
                                                    <p class="text-gray-900 leading-none"><strong>Code: </strong>{{ $product->code }}</p>
                                                    <p class="text-gray-600 mb-4"><strong>Stock: </strong>{{ $product->stock }}</p>
                                                    <a href=# class="btn-custom btn-primary justify-center text-white text-sm rounded">Buy</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                        @endforeach
                    </div>
                @else
                    <x-alert>
                        Sorry, item not found.
                    </x-alert>
                @endif  
                <div class="mt-4 px-4 mb-4">
                    {{ $products->links() }}
                </div>
                
               
            </div>
            
        </div>
    </div>
</x-app-layout>