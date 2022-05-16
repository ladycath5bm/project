<div class="card">   

    <div class="card-header">
        <input wire:model="search" class="form-control-sm float-left mt-2 mx-2" placeholder="Search by reference">
    </div>
    @if($orders->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <th>Ref.</th>
                    <th>Client</th>
                    <th>Email</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th class="col-span-2"></th>
            
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr>
                        <td><a href="{{ route('orders.report', $order) }}">{{ $order->reference }}</a></td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->customer_email }}</td>
                        <td>{{ $order->total }}</td>
                        <td> @if ($order->status === 'APPROVED') 
                                <span class="text-success">Approved</span>
                            @elseif ($order->status === 'PENDING')
                                <span class="text-warning">Pending</span>
                            @else
                                <span class="text-danger">Rejected</span>
                            @endif 
                        </td>
                    </tr>
                    @empty
                        <h3>Ups, no tienes ordenes registradas</h3>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $orders->links() }}
        </div>    
    @else
        <x-alert>
            Sorry, item not found.
        </x-alert>
    @endif    
</div>
