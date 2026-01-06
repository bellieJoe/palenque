
<div class="" >
    {{-- <button class="btn btn-primary" wire:click="showEditRoleModal">Add User</button> --}}
    <div class="modal fade " id="editRoleModal" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Edit Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name"  value="{{ $user ? $user->name : '' }}" disabled>
                    </div>
                    <div class="mb-2">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="role" wire:model.lazy="role">
                            <option value="">-Select Role-</option>
                            @foreach ($roleTypes as $roleType)
                                <option value="{{ $roleType->id }}" {{ $roleType->id == $role ? 'selected' : ''}}>{{ $roleType->name }}</option>
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
                                <option value="{{ $municipalMarket->id }}" {{ $municipalMarket->id == $municipal_market ? 'selected' : ''}}>{{ $municipalMarket->name }}</option>
                            @endforeach
                        </select>
                        @error('municipal_market') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" wire:loading.attr="disabled" wire:click="updateRole">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@script
<script>
    $wire.on('show-edit-role-modal', () => {
        $('#editRoleModal').modal('show');
    });
    $wire.on('hide-edit-role-modal', () => {
        $('#editRoleModal').modal('hide');
    });
</script>
@endscript
