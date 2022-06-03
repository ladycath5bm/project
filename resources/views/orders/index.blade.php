<x-app-layout>
    <div class="bg-white mx-8"> 
        <div class="flex items-center justify-center mt-4">
            <span class="flex justify-center mt-6 font-bold text-orange-600 text-3xl">Your purchases</span>
        </div>
        <div class="rounded-lg dhadow-sm p-6  text-center flex flex-col gap-5 mt-2  mx-10">
            @forelse ($orders as $order)
                <div class="card text-center rounded-md border">
                    <div class="card-header bg-gray-200 rounded-t flex">
                        <div class="basis-1/4">
                            <div class="flex justify-items-start mx-6 mt-2 text-xs">
                                <span>DATE</span>
                            </div>
                            <div class="flex justify-items-start mx-6  mb-2 text-xs">
                                <span>{{ $order->created_at }}</span>
                            </div>
                        </div>
                        <div class="basis-1/4">
                            <div class="flex justify-items-start mx-6 mt-2 text-xs">
                                <span>TOTAL</span>                       
                            </div>
                            <div class="flex justify-items-start mx-6 mb-2  text-xs">
                                <span class="text-orange-600 font-bold">$ {{ $order->total }}</span>
                            </div>
                        </div>
                        <div class="basis-3/4">
                            <div class="flex justify-end mx-6 mt-2 text-xs">
                                <span>REFERENCIA N. 
                                    <span class="font-bold">{{ $order->reference }}</span>
                                </span>
                            </div>
                            <div class="flex justify-end mx-6 mb-2  text-xs">
                                <span >
                                    <a class=" text-gray-600 hover:text-orange-600" href="{{ route('orders.show', $order) }}">Detalle de la orden  |</a>
                                </span>
                                <span>
                                    <a class="ml-2 text-gray-600 hover:text-orange-600" href="{{ route('orders.report', $order) }}">Ver factura</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body bg-gray-50 flex">
                        <div class="w-3/4">
                        @forelse ($order->products as $product)
                            <div class="flex w-full px-6 mt-6 mb-4">
                                <div class="md:w-2/3">
                                    @if($product->images->isNotEmpty() && $product->images->first()->url != '0')
                                        <img class="h-30 object-cover object-center rounded" src="{{ Storage::url($product->images->first()->url) }}" alt="">    
                                    @else
                                        <img class="h-30 object-cover object-center rounded" src="{{ asset('images/img_soport.jpg') }}" alt="">
                                    @endif
            
                                </div>
                                <div class="w-full ml-2 mt-6">
                                    <div class="flex justify-items-start">
                                        <span class="text-md font-bold text-gray-700 justify-start">{{ $product->name }}</span>
                                    </div>
                                    <div class="flex justify-start">
                                        <span class="text-sm text-gray-600 text-left ">{{ $product->description }}</span>
                                    </div>
                                    <div class="flex justify-items-start">
                                        <span class="text-xs text-gray-500 items-start">Code: {{ $product->code }}</span>
                                    </div>
                                    
                                </div>
                                <div class="w-full font-semibold text-gray-700 mr-4 justify-end mt-6">
                                    <span class="text-sm">$ {{ $product->price }} Und</span>
                                </div>    
                            </div>
                            
                        @empty
                            <span>Ho hay productos</span>
                        @endforelse
                        </div>
                        <div class="w-1/4 justify-items-center flex-col py-4 px-4">
                            <div class="flex w-3/4"><a class="w-full btn-custom  mt-4 bg-orange-400 font-semibold flex justify-center text-gray-800 text-xs rounded hover:bg-orange-500 hover:ring-orange-500 hover:text-white" href="#">Rastrear pedido</a></div>
                            <div class="flex w-3/4"><a class="w-full btn-custom  mt-4 bg-orange-400 font-semibold flex justify-center text-gray-800 text-xs rounded hover:bg-orange-500 hover:ring-orange-500 hover:text-white" href="{{ route('payments.reverse', $order) }}">Cancelar pedido</a></div>    
                        </div>
                        
                    </div>
                    <div class="card-footer py-2 text-muted flex border-t bg-gray-50">
                        <div>
                            <div class="flex justify-items-start mx-6 text-xs">
                                <span class="text-gray-900 font-semibold">Estado de pago</span>
                            </div>
                            @if($order->status == "REJECTED")
                                <div class="flex justify-items-start mx-6 text-xs">
                                    <span>{{ $order->status }}</span>
                                </div>
                                <div>
                                    <a class="text-xs flex justify-items-start mx-6 hover:text-orange-500 font-extralight text-gray-400" href="{{ route('payments.retray', $order) }}">Retray payment</a>
                                </div>
                            @elseif($order->status == "CREATED")
                                <div class="flex justify-items-start mx-6 text-xs">
                                    {{ $order->status }}
                                </div>
                                <div>
                                    <a class="text-xs flex justify-items-start mx-6 hover:text-orange-500 font-extralight text-gray-400" href="{{ route('payments.retray', $order) }}">Pay</a>
                                </div>
                            @else
                                <div class="flex justify-items-start mx-6 text-xs">
                                    <span>{{ $order->status }}</span>
                                </div>
                            @endif

                        </div>
                        <div>
                            <form action="{{ route('orders.destroy', $order) }}" method="POST" id="delete" name="delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="delete" class="text-orange-500">
                                    @if($order->status == "REJECTED")
                                        <span class="mt-3 material-icons hover:text-orange-400">
                                            delete_forever
                                        </span>
                                    @endif
                                </button>
                            </form>
                        </div>  
                    </div>
                </div>
            @empty
                <span class="px-6 py-2 text-sm text-gray-700">Ups! you don't have orders</span>
            @endforelse
            <div>
                {{ $orders->links() }}
            </div>
        </div>
        
    </div>
</x-app-layout>
