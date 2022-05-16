<x-app-layout>
    <div class="flex justify-center border bg-white px-12 rounded-md">
        <div class="mt-6 mb-6 px-20 border bg-white shadow-xl rounded-md w-full">
            <div class="px-4 mt-4"> 
                <span class="font-bold text-gray-700 text-xl">Your data</span>
                <hr/>
            </div>
            <div class="p-4 justify-center">
                <form id="payment" action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <br>
                        <input type="text" name="name" id="name" class="text-sm w-full py-1 rounded-md focus:outline-none focus:ring-1 focus:border-orange-500 focus:ring-orange-600 shadow-md" value="{{ auth()->user()->name }}"  required>
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>    
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <br>
                        <input type="email" name="email" id="email" class="text-sm w-full py-1 rounded-md focus:outline-none focus:ring-1 focus:border-orange-500 focus:ring-orange-600 shadow-md" value="{{ auth()->user()->email }}" required>
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>    
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="document">Document</label>
                        <br>
                        <input type="text" name="document" id="document" class="text-sm w-full py-1 rounded-md focus:outline-none focus:ring-1 focus:border-orange-500 focus:ring-orange-600 shadow-md" required>
                    </div>
                    @error('document')
                        <span class="text-danger">{{ $message }}</span>    
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="mobile">Phone</label>
                        <br>
                        <input type="text" name="mobile" id="mobile" class="text-sm w-full py-1 rounded-md border focus:outline-none focus:ring-1 focus:border-orange-500 focus:ring-orange-600 shadow-md" required>
                    </div>
                    @error('mobile')
                        <span class="text-danger">{{ $message }}</span>    
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="address">Addres</label>
                        <br>
                        <input type="text" name="address" id="address" class="text-sm w-full py-1 rounded-md border focus:outline-none focus:ring-1 focus:border-orange-500 focus:ring-orange-600 shadow-md" required>
                    </div>
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>    
                    @enderror
                </form>
                <div class="flex justify-between mt-4 ">
                    <button type="submit" form="payment" class="px-6 py-2 bg-orange-600 text-sm font-bold text-white hover:bg-orange-700 rounded-md justify-center">
                        Pay
                    </button>
                    
                    <a class="px-6 py-2 bg-gray-900 text-sm text-white  rounded-md " href="{{ route('cart.index') }}">Cancel</a>
                </div>
                
            </div>
            
        </div>
        <div class="mt-6 mb-6  ml-10 border px-6 bg-gray-50 shadow-xl rounded-md w-1/2">
            <table class="table w-full">
                <thead>
                    <span class="font-bold text-xl text-gray-600 flex justify-center mt-4 mb-4">My Cart</span>
                </thead>
                <tbody>
                    <span class="px-4">Products: ({{ Cart::count() }})</span>
                    @foreach ($items as $item)
                    <tr>
                        <hr/>
                        <td>
                            <div class="px-4 mt-2 mb-2 w-full">
                                @if($item->options['url'])
                                    <img class="h-20 object-cover object-center rounded" src="{{ Storage::url($item->options['url']) }}" alt="">    
                                @else
                                    <img class="h-20 object-cover object-center rounded" src="{{ asset('images/img_soport.jpg') }}" alt="">
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
                    @endforeach
                    <tr>
                        
                        <td>
                            <hr/>
                            <span class="mx-4 text-md text-gray-600  mt-4 mb-4">Subtotal</span>
                        </td>
                        <td>
                            <hr/>
                            <span class="mx-4 text-md text-gray-600  mt-4 mb-4">$ {{  Cart::subtotal() }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="mx-4 text-sm text-gray-500  mt-4 mb-4">Shipping</span>
                        </td>
                        <td>
                            <span class="mx-4 text-sm text-gray-500  mt-4 mb-4">$ 00000</span>
                        </td>
                    </tr>
                    
                </tbody>
                <tfoot>
                    <tr class="shadow-md">
                        <td>
                            <hr/>
                            <span class="mx-4 text-md text-gray-900 font-bold mt-4 mb-4">Total</span>
                        </td>
                        <td>
                            <hr/>
                            <span class="mx-4 text-md text-gray-900 font-bold mt-4 mb-4">$ {{  Cart::subtotal() }}</span>
                        </td>
                    </tr>
                </tfoot>
            </table>
            
        </div>
    </div>

    
</x-app-layout>