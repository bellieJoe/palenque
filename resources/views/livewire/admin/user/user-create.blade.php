<div class="" >
    <button class="btn btn-primary" wire:click="showCreateUserModal">Add User</button>
    <div class="modal fade " id="createUserModal" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" wire:model.lazy="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" wire:model.lazy="email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="role" wire:model.lazy="role">
                            <option value="">-Select Role-</option>
                            @foreach ($roleTypes as $roleType)
                                <option value="{{ $roleType->id }}">{{ $roleType->name }}</option>
                            @endforeach
                        </select>
                        @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    @if ($role != 1)
                    <div class="mb-2">
                        <label for="municipal_market" class="form-label">Municipal Market</label>
                        <select class="form-control" id="municipal_market" wire:model.lazy="municipal_market" {{ auth()->user()->isAdmin() ? '' : 'disabled' }}>
                            <option value="">-Municipal Market-</option>
                            @foreach ($municipalMarkets as $municipalMarket)
                                <option value="{{ $municipalMarket->id }}">{{ $municipalMarket->name }}</option>
                            @endforeach
                        </select>
                        @error('municipal_market') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" wire:loading.attr="disabled" wire:click="saveUser">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@script
<script>
    $wire.on('show-create-user-modal', () => {
        $('#createUserModal').modal('show');
    });
    $wire.on('hide-create-user-modal', () => {
        $('#createUserModal').modal('hide');
    });
</script>
@endscript
