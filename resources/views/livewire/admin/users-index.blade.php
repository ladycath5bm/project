<div class="card">   

    <div class="card-header">
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
                        <td> 
                            @if(isset( $user->roles()->first()->name )) {{ $user->roles()->first()->name }} @else 'Not role' @endif 
                        </td>
                        <td width="10px">
                            <a class="btn btn-sm btn-success" href="{{ route('admin.users.edit', $user) }}">Role</a>
                        </td>
                        <td width="10px">
                            
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
