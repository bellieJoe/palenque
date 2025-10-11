<?php

namespace App\Livewire\Admin\User;

use App\Models\MunicipalMarket;
use App\Models\Role;
use App\Models\RoleType;
use App\Models\User;
use App\Notifications\UserCreatedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;

class UserCreate extends Component
{
    public $roleTypes;
    public $municipalMarkets;

    #[Validate('required|exists:role_types,id')]
    public $role = '';
    #[Validate('required_if:role,2,3,4,5,6|exists:municipal_markets,id')]
    public $municipal_market = '';
    #[Validate('required|max:255')]
    public $name = '';
    #[Validate('required|email|unique:users,email|max:255')]
    public $email = '';


    public function showCreateUserModal(){
        $this->dispatch('show-create-user-modal');
        $this->reset(['name', 'email']);
        $this->resetErrorBag();
    }

    public function hideCreateUserModal(){
        $this->dispatch('hide-create-user-modal');
        $this->reset(['name', 'email']);
        $this->resetErrorBag();
    }

    public function saveUser(){
        $this->validate();
        $password = Str::random(8);
        DB::transaction(function () use ($password) {
            $user = User::create([
                "name" => $this->name,
                "email" => $this->email,
                "password" => bcrypt($password),
            ]);
            Role::create([
                "user_id" => $user->id,
                "role_type_id" => $this->role,
                "municipal_market_id" => $this->role != 1 ? $this->municipal_market : null
            ]);
            Notification::send($user, new UserCreatedNotification($password));
            notyf()->position('y', 'top')->success('User created successfully!');
            $this->dispatch('hide-create-user-modal');
            $this->dispatch('user-created');
            return;
        });
    }

    public function render()
    {
        return view('livewire.admin.user.user-create');
    }

    public function mount(){
        $this->roleTypes = RoleType::all();
        $this->municipalMarkets = MunicipalMarket::all();
    }
}
