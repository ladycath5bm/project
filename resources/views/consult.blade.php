<x-app-layout>
                
    <div class="bg-white rounded-lg dhadow-sm p-4 text-center flex flex-col gap-5">
        <table>
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Reference</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customerName }}</td>
                    <td>{{ $order->customerEmail }}</td>
                    <td>{{ $order->referenceId }}</td>
                    <td>{{ $order->status }}</td>      
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>