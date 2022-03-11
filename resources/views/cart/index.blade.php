<x-app-layout>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-6 mb-4">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex items-center justify-center mt-4"><span class="flex justify-center font-bold text-gray-500 text-2xl">Cart Shopping</span></div>
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200 flex">
                
                <div class="border rounded-md  mr-6">
                    <div class="p-4">
                        <form id="pay" action="#">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="rounded-md shadow-md" value="{{ auth()->user()->name }}" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="rounded-md shadow-md" value="{{ auth()->user()->email }}" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="document">Document</label>
                                <input type="text" name="document" id="document" class="rounded-md shadow-md" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="address">Addres</label>
                                <input type="text" name="address" id="address" class="rounded-md shadow-md" required>
                            </div>
                        </form>
                    </div>
                    
                </div>
                <div class="bg-white rounded-lg dhadow-sm p-4 text-center w-full gap-5 flex border">
                    <table class="table flex-col w-full">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::content() as $item)
                                <tr>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->qty * $item->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="border border-gray-600 rounded-md">
                            <tr >
                                <th scope="row">Total</th>
                                <td colspan="2">{{ Cart::subtotal() }}</td>
                            </tr>
                        </tfoot>
                    </table>    
                </div>
            </div>
            <div class="mt-2 mb-4 mx-6">
                <div class="mx-6">
                    <div class="px-6">
                        <div class="btn-group">
                            <button type="submit" form="pay" class="btn px-6 py-2 bg-orange-600 text-md font-bold text-white hover:bg-orange-700 mb-2 mx-6 rounded-md">
                                Buy
                            </button>
                            <form id="empty-cart" action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                @method('POST')
                            </form>
                            <button type="submit" form="empty-cart" class="btn px-6 py-2 bg-gray-900 text-sm text-white mx-6 rounded-md ">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>