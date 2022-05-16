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
    <div class="bg-gray-100 py-6 text-center flex flex-col mt-4 px-24">
        <div class="px-6">
            <table>
                <thead class="bg-gray-200 rounded-md">
                    <tr>
                        <th class="px-6 py-2 text-md text-gray-700" scope="col">#</th>
                        <th class="px-6 py-2 text-md text-gray-700" scope="col">Code</th>
                        <th class="px-6 py-2 text-md text-gray-700" scope="col">Product</th>
                        <th class="px-6 py-2 text-md text-gray-700" scope="col">Description</th>
                        <th class="px-6 py-2 text-md text-gray-700" scope="col"></th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                        @forelse ($top as $product)
                        <tr>
                            
                            <td class="px-6 py-3 text-gray-600 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-6 py-3 text-orange-600 text-md">
                                <a href="{{ route('products.show', $product->product_id) }}">{{ $product->product->code }}</a>
                            </td>
                            <td class="px-6 py-3 text-gray-600 text-md">{{ $product->product->name }}</td>
                            <td class="px-6 py-3 text-gray-600 text-md">{{ $product->product->description }}</td>
                            <td class="px-6 py-3 text-gray-600 text-md">
                                <div class="mb-6 mx-4 mt-4 flex-col flex items-center justify-center w-full">
                                    @if($product->product->images->isNotEmpty() && $product->product->images->first()->url != '0')
                                        <img class="h-40 object-cover object-center rounded" src="{{ Storage::url($product->product->images->first()->url) }}" alt="">    
                                    @else
                                        <img class="h-40 object-cover object-center rounded" src="{{ asset('images/img_soport.jpg') }}" alt="">
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                            <span>List empty</span>
                        @endforelse
                </tbody>
                <tfoot></tfoot>
           </table>
        </div>
    </div>
</x-app-layout>