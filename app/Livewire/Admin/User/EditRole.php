<?php

namespace App\Livewire\Admin\User;

use App\Models\MunicipalMarket;
use App\Models\Role;
use App\Models\RoleType;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditRole extends Component
{
    protected $listeners = [
        'edit-role' => 'showEditRoleModal'
    ];
    public $roleTypes;
    public $municipalMarkets;
    public User $user;
    #[Validate('required|exists:role_types,id')]
    public $role;
    #[Validate('required_if:role,2,3,4,5,6|exists:municipal_markets,id')]
    public $municipal_market;

    public function showEditRoleModal($id){
        $this->user = User::where('id', $id)->with('roles')->first();
        $this->role = $this->user->roles->first()->role_type_id;
        $this->municipal_market = $this->user->roles->first()->municipal_market_id;
        $this->dispatch('show-edit-role-modal');
    }

    public function updateRole(){
        $this->validate();
        Role::where('user_id', $this->user->id)->update([
            "role_type_id" => $this->role,
            "municipal_market_id" => $this->role != 1 ? $this->municipal_market : null
        ]);
        notyf()->position('y', 'top')->success('Role updated successfully!');
        $this->dispatch('hide-edit-role-modal');
        $this->reset(['role', 'municipal_market', 'user']);
    }

    public function render()
    {
        return view('livewire.admin.user.edit-role');
    }
    
    public function mount(){
        $this->roleTypes = RoleType::whereIn('id',  auth()->user()->isAdmin() ? [7] : [2, 4, 5])->get();
        $this->municipalMarkets = MunicipalMarket::all();
    }
}
