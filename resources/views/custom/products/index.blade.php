<x-app-layout>
    @section('sidebar')
    <div class="min-h-screen px-4 py-4 rounded bg-gray-100 ">
        <div class="flex flex-wrap justify-center bg-white rounded-lg shadow-lg mb-4">
            <button class="font-bold flex-grow text-orange-500 rounded-lg shadow-lg bg-white text-md h-12">Category</button>            
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
            
    <div class="card mr-2">
        <div class="card-body">
            <div class="max-w-screen sm:px-8 lg:px-2 ">
                <div class="mx-4">
                    
                    <!--<input wiremodel="search" class=" rounded form-control-lg mt-2 mx-6 px-6" placeholder="Search">-->
            
                </div>
                
                @if($products)
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                    
                        @foreach ($products as $product)
                            <div class="col-span-1 md:col-span-1 xl:col-span-1">
                                <div class="max-w-sm h-full md:max-w-full">
                                    
                                    <div class="max-w-full  h-full bg-white rounded lg:rounded p-1 flex flex-col shadow-lg justify-between leading-normal">
                                        
                                        <div class="justify-center mb-2 rounded flex items-center">
                                            @if($product->images->isNotEmpty())
                                                <img class="h-60 object-cover object-center rounded" src="{{ Storage::url($product->images->first()->url) }}" alt="">    
                                            @else
                                                <img class="h-60 object-cover object-center rounded" src="{{ asset('images/image.jpg') }}" alt="">
                                            @endif
            
                                        </div>
                                        <div class="mb-2 mx-2">
                                            <p class="text-sm text-gray-600 flex items-center">
                                                {{ $product->description }}
                                            </p>
                                            <div class="text-sm ">
                                                <div class="text-gray-900 font-bold text-xl">
                                                        <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                                </div>
                                            
                                                    <p class="text-orange-600 text-base mb-1"><strong>$ </strong>{{ $product->price }}</p>
                                                    <!--<p class="text-gray-900 leading-none text-sm"><strong>Code: </strong>{{ $product->code }}</p>-->
                                                    <!--<p class="text-gray-600 mb-2"><strong>Stock: </strong>{{ $product->stock }}</p>-->
                                                    <div class="flex items-center justify-center">
                                                        <form id="add-cart-{{ $product->id }}" action="{{ route('products.index') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                                        </form>
                                                        <button type="submit" class="btn-custom bg-white  px-6 justify-center text-gray-900 font-bold text-sm rounded hover:bg-orange-600 hover:ring-orange-600 hover:text-white" form="add-cart-{{ $product->id }}">
                                                            Buy
                                                        </button>

                                                        
                                                    </div>
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