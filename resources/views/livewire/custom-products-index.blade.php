<div class="max-w-3xl sm:px-4 lg:px-2 ">
    <div class="mx-4 mt-4">
        
        <input wire:model="search" class=" rounded form-control-lg mt-2 mx-6 px-6" placeholder="Search">

    </div>
    @if($products)
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mx-4 ">
        
            @foreach ($products as $product)
                <div class="col-span-1 lg:col-span-1 xl:col-span-1 flex-col">
                    <div class="max-w-sm h-full lg:max-w-full mt-4">
                        
                        <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded lg:rounded p-4 flex flex-col justify-between leading-normal">
                            
                            <div class="flex items-center mb-2 mt-2 rounded">
                                <img class="h-60 object-cover object-center rounded" src="@if(isset($product->images->first()->url)) {{ Storage::url($product->images->first()->url) }} @else http://wallup.net/wp-content/uploads/2016/03/10/322474-sunlight-winter-landscape-snow.jpg @endif" alt="">

                            </div>
                            <div class="mb-2 mx-2">
                                <p class="text-sm text-gray-600 flex items-center mb-2">
                    
                                </p>
                                <div class="text-sm mx-4">
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
