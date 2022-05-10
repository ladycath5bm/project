<x-app-layout>
    <div class="mx-8"> 
        <div class="flex items-center justify-center mt-4">
            <span class="flex justify-center font-bold text-orange-600 text-3xl">Consult your payment</span>
        </div>
        <div class="px-12 mt-8 flex items-start justify-start">
            <span class="flex justify-center text-gray-700 text-sm">, mira el detalle</span>
        </div>
        <div class="bg-white rounded-lg dhadow-sm p-6  text-center flex flex-col gap-5 mt-4  mx-10">
            <table>
                <thead class="bg-gray-200 rounded-md">
                    <tr>
                        <th class="px-6 py-2 text-md text-gray-700" scope="col">Date</th>
                        <th class="px-6 py-2 text-md text-gray-700" scope="col">Name</th>
                        <th class="px-6 py-2 text-md text-gray-700" scope="col">Email</th>
                        <th class="px-6 py-2 text-md text-gray-700" scope="col">Reference</th>
                        <th class="px-6 py-2 text-md text-gray-700" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-6 py-3 text-gray-600 text-sm">{{ $order->created_at }}</td>
                        <td class="px-6 py-3 text-gray-600 text-md">{{ $order->customer_name }}</td>
                        <td class="px-6 py-3 text-gray-600 text-md">{{ $order->customer_email }}</td>
                        <td class="px-6 py-3 text-gray-600 text-md">{{ $order->reference }}</td>
                        <td class="px-6 py-3 text-gray-600 text-md">
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
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 rounded-lg dhadow-sm px-6 mt-1 mx-10 flex"> 
            <a href="{{ route('orders.index') }}" class="btn px-6 py-2 bg-orange-600 text-sm font-bold text-white hover:bg-orange-700 mt-2 mb-2 rounded-md">Back</a>
        </div>
    </div>
</x-app-layout>