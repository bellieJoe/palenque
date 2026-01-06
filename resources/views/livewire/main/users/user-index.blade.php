<div>
    @livewire('admin.user.edit-role')
    <x-page-header title="Users" />
    <div class="d-flex justify-content-end mb-2">
        @livewire('admin.user.user-create')
    </div>
    <div class="card">
        <div class="card-body">
            <input wire:model.live.debounce.300ms="search" type="text" class="form-control mb-3" placeholder="Search users...">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>    
                                <td> <img src="https://api.dicebear.com/9.x/identicon/svg?seed={{ $user->name }}" class="rounded-circle mr-2" width="25px" alt="" >{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <button class="btn btn-outline-primary " title="Edit Role" wire:click="editRole({{$user}})"><i class="fas fa-edit"></i></button>
                                    {{ $user->roles->first()->roleType->name }}
                                </td>
                                <td>
                                    <!-- Example actions -->
                                    <button class="btn btn-outline-danger" wire:click="deleteUser({{$user}})" wire:confirm="Are you sure you want to delete this post?">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination links -->
            <div class="d-flex justify-content-center mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
