<div class="card">   

    <div class="card-header">
        <a class="btn btn-warning btn-sm float-right" href="{{ route('admin.products.create') }}">Add product</a>

        
        <input wire:model="search" class="form-control-sm float-left mt-2 mx-2" placeholder="Search">

    </div>
    @if($products->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Status</th>
                    <th>Stock</th>
                    <th class="col-span-2"></th>
            
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><a href="{{ route('admin.products.show', $product) }}">{{ $product->name }}</a></td>
                        <td>{{ $product->code }}</td>
                        <td> @if ($product->status == 'ENABLED') 
                                <span class="text-success">Enabled</span>
                            @else 
                                <span class="text-danger">Disabled</span>
                            @endif 
                        </td>
                        <td>
                            @if( $product->stock == 0 )
                                <span class="text-dark text-center">{{ $product->stock }}</span>
                                <br>
                                <span class="text-xs text-danger text-center">Sold Out</span>
                            @else
                                <span class="text-dark text-center">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td width="10px">
                            <a class="btn btn-sm btn-success" href="{{ route('admin.products.edit', $product) }}">Edit</a>
                        </td>
                        <td width="10px">
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <h3>Upds, no tienes productos registrados aún</h3>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $products->links() }}
        </div>    
    @else
        <x-alert>
            Sorry, item not found.
        </x-alert>
    @endif    
</div>
