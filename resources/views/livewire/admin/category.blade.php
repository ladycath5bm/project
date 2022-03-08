<div class="card">   

        <div class="card-header">
            <a class="btn btn-dark btn-sm float-right" href="{{ route('admin.categories.create') }}">Add categories</a>
            <!--<input wiremodel="search" class="form-control-sm float-left" placeholder="Search">-->

        </div>
        @if($categories->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th class="col-span-2"></th>
                
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td width="10px">
                                <a class="btn btn-sm btn-success" href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
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
                {{ $categories->links() }}
            </div>    
        @else
            <x-alert>
                Sorry, item not found.
            </x-alert>
        @endif    
</div>