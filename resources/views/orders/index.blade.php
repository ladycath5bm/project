<x-app-layout>
    <div class="mx-8"> 
        <div class="flex items-center justify-center mt-4">
            <span class="flex justify-center font-bold text-orange-600 text-3xl">Your purchases</span>
        </div>
        <div class="bg-white rounded-lg dhadow-sm p-6  text-center flex flex-col gap-5 mt-8  mx-10">
            <table>
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-2 text-sm text-gray-700" scope="col">Date</th>
                        <th class="px-6 py-2 text-sm text-gray-700" scope="col">Reference</th>
                        <th class="px-6 py-2 text-sm text-gray-700" scope="col">Description</th>
                        <th class="px-6 py-2 text-sm text-gray-700" scope="col">Total</th>
                        <th class="px-6 py-2 text-sm text-gray-700" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr class="rounded-md border-b">
                        <td class="px-6 py-3 text-gray-600 text-xs">{{ $order->created_at }}</td>
                        <td class="px-6 py-3 text-gray-600 text-sm"><a href="#" class="hover:text-orange-500">{{ $order->reference }}</a></td>
                        <td class="px-6 py-3 text-gray-600 text-sm">{{ $order->description }}</td>
                        <td class="px-6 py-3 text-gray-600 text-sm">{{ $order->total }}</td>
                        <td class="px-6 py-3 text-gray-600 text-sm">
                            @if($order->status == "REJECTED")
                                {{ $order->status }}    
                                <br>
                                <a class="text-xs hover:text-orange-500 font-extralight text-gray-400" href="{{ route('retray', $order) }}">Retray payment</a>
                            @elseif($order->status == "CREATED")
                                {{ $order->status }}
                                <br>
                                <a class="text-xs hover:text-orange-500 font-extralight text-gray-400" href="{{ route('retray', $order) }}">Pay</a>
                            @else
                                {{ $order->status }}
                            @endif
                        </td>          
                    </tr>
                    @empty 
                        <span class="px-6 py-2 text-sm text-gray-700">Ups! you don't have orders</span>
                    @endforelse
                </tbody>
            </table>
            
        </div>
        <div class="bg-gray-50 rounded-lg dhadow-sm px-6 mt-1 mx-10"> 
            <button class="btn px-6 py-2 bg-orange-600 text-sm font-bold text-white hover:bg-orange-700 mt-2 mb-2 rounded-md">Back</button>
        </div>
    </div>
</x-app-layout>

