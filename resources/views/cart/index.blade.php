<x-app-layout>

    <div class="max-w-7xl mx-auto sm:px-4 lg:px-2 mb-4">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex items-center justify-center mt-6">
                <span class="flex justify-center font-bold text-gray-800 text-3xl">Cart Shopping</span>
            </div>
            <div class="px-10 mt-4">
                <span class="text-gray-600 text-xl mx-4 font-bold">Products: {{ Cart::content()->count() }}</span> 
            </div>
            <div class="sm:px-2 md:px-10 lg:px-10 bg-white border-b border-gray-200 flex">
                
                <div class="bg-white w-full">
                    
                    <div class="bg-white rounded-lg text-center w-full gap-5">
                        @forelse (Cart::content() as $item)
                      
                            <div class="border rounded-md shadow-md px-2 py-2 mb-6 mt-6">
                                <div class="flex w-full">
                                    <div class="w-1/4">
                                        @if($item->options['url'])
                                            <img class="h-30 object-cover object-center rounded" src="{{ Storage::url($item->options['url']) }}" alt="">    
                                        @else
                                            <img class="h-30 object-cover object-center rounded" src="{{ asset('images/image.jpg') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="w-1/3 ml-2 mt-6">
                                        <div class="flex justify-items-start">
                                            <span class="text-lg font-bold text-gray-700 justify-start">{{ $item->name }}</span>
                                        </div>
                                        <div class="flex justify-items-start">
                                            <span class="text-sm text-gray-500 justify-start">{{ $item->options['code'] }}</span>
                                        </div>
                                        
                                    </div>
                                    <div class="w-1/4 font-bold text-gray-700 mr-4 justify-end mt-6">
                                        <span class="text-lg">$ {{ $item->price }} Und</span>
                                    </div>
                                    <div class="w-1/4 mt-6">
                                        <div class="flex justify-center">
                                            <div class="mb-3 xl:w-96">
                                                <form id="update" action="{{ route('cart.update') }}" method="POST" >
                                                    @csrf
                                                    <input type="hidden" name="id" id="id" value="{{ $item->rowId }}">
                                                    <select name="qty" id="qty" class="form-select form-select-sm btn-sele">
                                                        <option selected="{{ $item->qty }}">{{ $item->qty }}</option>|
                                                        @if($item->options['stock'] <= 5)
                                                            @for ( $stock = 1;  $stock <= $item->options['stock']; $stock++)
                                                                @if (1 == $item->qty and $stock == 1)
                                                                    break;
                                                                @else
                                                                    <option value="{{ $stock }}">{{ $stock }}</option>
                                                                @endif
                                                            @endfor
                                                        @else
                                                            @for ( $stock = 1; $stock <= 8; $stock++)
                                                                @if (1 == $item->qty and $stock == 1)
                                                                    break;
                                                                @else
                                                                    <option value="{{ $stock }}">{{ $stock }}</option>
                                                                @endif
                                                             @endfor
                                                        @endif
                                                    </select>
                                                    <button type="submit" class="text-sm text-orange-500 justify-center text-center">
                                                        Update
                                                    </button>
                                                </form>                                    
                                            </div>
                                            <div class="flex justify-center mt-2 px-3">
                                                <form name="delete" id="delete" action="{{ route('cart.remove', $item->rowId) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $item->rowId }}">
                                                    <button name="delete" type="submit" class="text-sm text-orange-500 ">
                                                        <span class="material-icons hover:text-orange-400">
                                                            delete
                                                        </span>
                                                    </button>
                                                </form>
                                               
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        
                        @empty
                            <span class="text-gray-800 text-lg font-bold">Cart empty</span>        
                        @endforelse
                    </div>
                    <div class="py-4 px-6 flex justify-between rounded-md mb-4 border-2 border-orange-500">
                        <a class="text-gray-800 text-lg font-bold" href="{{ route('products.index') }}">Keep shopping</a>
                        <form class="text-lg" action="{{ route('cart.clear') }}" method="POST" id="clear" name="clear">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="clear" class="text-orange-500" form="clear">
                                <span class="material-icons hover:text-orange-400">
                                    delete_forever
                                </span>
                                    
                            </button>
                        </form>
                        
                    </div>
                    
                </div>
                
                <div class="bg-white ml-10 py-6 w-1/2">
                    <div class="border rounded-md  bg-gray-100">
                        <table class="table w-full">
                            <thead>
                                <span class="font-bold text-xl text-gray-600 flex justify-center mt-4 mb-4">My Cart</span>
                            </thead>
                            <tbody>
                                @forelse (Cart::content() as $item)
                                <tr>
                                    <hr/>
                                    <td>
                                        <div class="pl-4 mt-2 mb-2 w-full">
                                            @if($item->options['url'])
                                                <img class="h-20 object-cover object-center rounded" src="{{ Storage::url($item->options['url']) }}" alt="">    
                                            @else
                                                <img class="h-20 object-cover object-center rounded" src="{{ asset('images/image.jpg') }}" alt="">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="mx-4 text-sm font-bold text-gray-600  mt-4 mb-4">{{  $item->name }}</span>
                                        <br>
                                        <span class="mx-4 text-sm text-gray-600  mt-4 mb-4">Cant: {{ $item->qty }}</span>
                                        <br>
                                        <span class="mx-4 text-sm font-bold text-gray-700  mt-4 mb-4">$ {{ $item->price }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <div>
                                        <span class="flex justify-center text-sm font-semibold text-gray-700  mt-4 mb-4"> Ups!, no tienes productos en tu carrito</span>
                                    </div>
                                </tr>
                                @endforelse
                                <tr>
                                    <td>
                                        <hr/>
                                        <span class="mx-4 text-md text-gray-700  mt-4 mb-4">Subtotal</span>
                                    </td>
                                    <td>
                                        <hr/>
                                        <span class="mx-4 text-md text-gray-700  mt-4 mb-4">$ {{  Cart::subtotal() }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="mx-4 text-md text-gray-500  mt-4 mb-4">Shipping</span>
                                    </td>
                                    <td>
                                        <span class="mx-4 text-md text-gray-500  mt-4 mb-4">$ 00000</span>
                                    </td>
                                </tr>
                                
                            </tbody>
                            <tfoot>
                                <tr class="border-t rounded-md">
                                    <td class="rounded-md text-center">
                                        <span class="mx-4 text-center text-md text-gray-900 rounded font-bold mt-4 mb-4">Total</span>
                                    </td>
                                    <td>
                                        <span class="mr-4 text-lg text-gray-900 font-bold mt-4 mb-4">$ {{  Cart::subtotal() }}</span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="flex items-center justify-center">
                        <a class="btn-custom  mt-4 w-full bg-orange-500  px-6 flex justify-center text-white font-bold text-md rounded hover:bg-orange-500 hover:ring-orange-500 hover:text-white" href="{{ route('cart.checkout') }}">Continue</a>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>