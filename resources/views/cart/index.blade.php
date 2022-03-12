<x-app-layout>

    <div class="max-w-7xl mx-auto md:px-2 lg:px-2 mb-4">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex items-center justify-center mt-4"><span class="flex justify-center font-bold text-gray-500 text-2xl">Cart Shopping</span></div>
            <div class="p-6 sm:px-10 bg-white border-b border-gray-200 flex">
                
                <div class="bg-white w-full">
                    
                    <div class="bg-white rounded-lg text-center w-full gap-5">
                        @foreach ($items as $item)
                            <div class="border rounded-md shadow-md px-2 py-2 mb-6 mt-6">
                                <div class="flex w-full">
                                    <div class="mr-2 w-1/4">
                                        @if($item->options['url'])
                                            <img class="h-30 object-cover object-center rounded" src="{{ Storage::url($item->options['url']) }}" alt="">    
                                        @else
                                            <img class="h-30 object-cover object-center rounded" src="{{ asset('images/image.jpg') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="w-1/3">
                                        <div class="flex justify-items-start">
                                            <span class="text-md font-bold text-gray-700 justify-start">{{ $item->name }}</span>
                                        </div>
                                        <div class="flex justify-items-start">
                                            <span class="text-sm text-gray-500 justify-start">{{ $item->options['code'] }}</span>
                                        </div>
                                        
                                    </div>
                                    <div class="w-1/4 font-bold text-gray-700 mr-4 justify-end">
                                        <span>$ {{ $item->price }}</span>
                                    </div>
                                    <div class="w-1/4">
                                        <select name="qty" id="qty" value="{{ $item->qty }}"></select>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                    
                </div>
                
                <div class="bg-white ml-10 py-6 w-1/2">
                    <div class="border rounded-md  bg-gray-100">
                        <table class="table table-light w-full">
                            <thead>
                                <th scope="col">gggg</th>
                                <th scope="col">gggg</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
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