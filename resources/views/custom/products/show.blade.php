<x-app-layout>
    @section('sidebar')
        <nav class="bg-white px-10 shadow-xl py-2 text-center">
            @foreach ($categories as $category)      
                <a href="{{ route('products.showbycategory', $category) }}" class=" hover:scale-115">
                    <span class="text-sm text-gray-500 hover:text-orange-500">{{ $category->name }}</span>
                    <span class="text-orange-600 text-md mx-4">|</span>
                </a>
            @endforeach
        </nav>
    @endsection
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4 mt-4 pb-4  bg-gray-100 rounded lg:rounded justify-between leading-normal">
        
        <a class="text-sm mt-1 text-gray-400" href="{{ route('products.index') }}">{{ __('Home ') }}></a>
        <a class="text-sm mt-1 text-gray-400" href="{{ route('products.showbycategory', $product->category) }}">{{ $product->category->name }}</a>

        <div >
            
            <div class="lg:col-span-2">
                
                <div class="max-w-sm h-full lg:max-w-full mt-2">
                    
                    <div class=" bg-white shadow-md rounded lg:rounded p-4 justify-between leading-normal">
                      
                      <div class="flex items-center mb-4 mt-4">
                        
                        
                        <div class="mb-6 mx-4 mt-4 flex-col flex items-center justify-center w-full">
                            @if($product->images->isNotEmpty() && $product->images->first()->url != '0')
                                <img class="h-90 object-cover object-center rounded" src="{{ Storage::url($product->images->first()->url) }}" alt="">    
                            @else
                                <img class="h-90 object-cover object-center rounded" src="{{ asset('images/img_soport.jpg') }}" alt="">
                            @endif
                        </div>
                        <div class="text-sm mx-4 mt-4 flex-col">
                            <div class="text-orange-600 font-bold text-2xl mb-2">{{ $product->name }}</div>
                            <p class="text-sm text-gray-600 flex items-center mb-2">
                                {{  $product->description }}
                            </p>
                            <p class="text-gray-700 text-2xl mb-4"><strong>$ </strong>{{ $product->price }}</p>
                            <p class="text-gray-900 leading-none"><strong>Code: </strong>{{ $product->code }}</p>
                            <p class="text-gray-600 mb-4"><strong>Stock: </strong>{{ $product->stock }}</p>

                            <div class="flex items-center justify-center">
                                <form id="add-cart-{{ $product->id }}" action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                </form>
                                <button type="submit" class="btn-custom w-full hover:text-orange-700 hover:bg-orange-300 rounded-md bg-orange-600 justify-center text-white font-bold text-sm  hover:ring-orange-300" form="add-cart-{{ $product->id }}">
                                    Buy
                                </button>
                            </div>
                            <div class="flex justify-items-end mt-4 text-xs text-orange-400 ">
                                <a  href="{{ route('top') }}">Products most visited!</a>
                            </div>
                            
                        </div>
                        
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <aside class="col-span-1 justify-items-center mt-6 ">
            <h1 class="text-2xl font-bold text-gray-600 mb-4 mt-4">
                Products similar in {{ $product->category->name }}
            </h1>
    
            <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-2 mt-4 ">
                @foreach ($similarProductsByCategory as $similar) 
                    
                <div class="col-span-1 md:col-span-1 xl:col-span-1">
                    <div class="max-w-sm h-full md:max-w-full">
                        
                        <div class="max-w-full  h-full bg-white rounded lg:rounded p-1 flex flex-col shadow-lg justify-between leading-normal">
                            
                            <div class="justify-center mb-2 rounded flex items-center">
                                @if($similar->images->isNotEmpty() && $similar->images->first()->url != '0')
                                    <img class="h-50 object-cover object-center rounded" src="{{ Storage::url($similar->images->first()->url) }}" alt="">    
                                @else
                                    <img class="h-50 object-cover object-center rounded" src="{{ asset('images/img_soport.jpg') }}" alt="">
                                @endif

                            </div>
                            <div class="mb-2 mx-2">
                                <p class="text-sm text-gray-600 flex items-center">
                                    {{  $similar->description }}
                                </p>
                                <div class="text-sm ">
                                    <div class="text-gray-900 font-bold text-xl">
                                            <a href="{{ route('products.show', $similar) }}">{{ $similar->name }}</a>
                                    </div>
                                
                                        <p class="text-orange-600 text-base mb-1"><strong>$ </strong>{{ $similar->price }}</p>
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