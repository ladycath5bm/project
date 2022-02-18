<div class="card">   

    <div class="card-header">
        <a class="btn btn-dark btn-sm float-right" href="{{ route('admin.users.create') }}">Add user</a>
        <input wire:model="search" class="form-control-sm float-left" placeholder="Search">

    </div>
    @if($users->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="col-span-2"></th>
            
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td> @if(isset( $user->roles()->first()->name )) {{ $user->roles()->first()->name }} @else '' @endif </td>
                        <td width="10px">
                            <a class="btn btn-sm btn-success" href="{{ route('admin.users.edit', $user) }}">Role</a>
                        </td>
                        <td width="10px">
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
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
            {{ $users->links() }}
        </div>    
    @else
        <x-alert>
            Sorry, item not found.
        </x-alert>
    @endif    
</div>
