<div class="card">   

    <div class="card-header">
        <a class="btn btn-dark btn-sm float-right" href="{{ route('admin.products.create') }}">Add products</a>
        <input wire:model="search" class="form-control-sm float-left" placeholder="Search">

    </div>
    @if($products->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th class="col-span-2"></th>
            
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><a href="{{ route('admin.products.show', $product) }}">{{ $product->name }}</a></td>
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
                    @endforeach
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
