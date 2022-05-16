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
            
    <div class="card mx-2">
        <div class="card-body">
            <div class="max-w-screen sm:px-8 lg:px-2 ">
                <div class="mx-4">
                    
            
                </div>
                
                @if($products)
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-2 mt-4">
                    
                        @foreach ($products as $product)
                            <div class="col-span-1 md:col-span-1 xl:col-span-1">
                                <div class="max-w-sm h-full md:max-w-full">
                                    
                                    <div class="max-w-full  h-full bg-white rounded lg:rounded p-1 flex flex-col shadow-lg justify-between leading-normal">
                                        
                                        <div class="justify-center mb-2 rounded flex items-center">
                                            @if($product->images->isNotEmpty() && $product->images->first()->url != '0')
                                                <img class="h-60 object-cover object-center rounded" src="{{ Storage::url($product->images->first()->url) }}" alt="">    
                                            @else
                                                <img class="h-60 object-cover object-center rounded" src="{{ asset('images/img_soport.jpg') }}" alt="">
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
                                                    <div class="flex items-center justify-center">
                                                        <form id="add-cart-{{ $product->id }}" action="{{ route('cart.store') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                                        </form>
                                                        <button type="submit" class="btn-custom bg-white w-full justify-center text-gray-900 font-bold text-sm rounded hover:bg-orange-600 hover:ring-orange-600 hover:text-white" form="add-cart-{{ $product->id }}">
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