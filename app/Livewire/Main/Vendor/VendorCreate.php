<?php

namespace App\Livewire\Main\Vendor;

use App\Models\Role;
use App\Models\User;
use App\Models\Vendor;
use App\Notifications\UserCreatedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;

class VendorCreate extends Component
{

    #[Validate('required|max:255')]
    public $name = "";
    #[Validate('nullable|max:100')]
    public $contact_number = "";
    #[Validate('required|max:100')]
    public $representative_name = "";
    #[Validate('required|email|max:60|unique:users,email')]
    public $email = "";

    public function saveVendor()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $password = Str::random(8);
                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => bcrypt($password),
                ]);
                $vendor = Vendor::create([
                    "name" => $this->name,
                    "user_id" => $user->id,
                    "contact_number" => $this->contact_number,
                    "representative_name" => $this->representative_name,
                    "municipal_market_id" => auth()->user()->marketDesignation()->id
                ]);
                Role::create([
                    'user_id' => $user->id,
                    'role_type_id' => 6,
                    'municipal_market_id' => $vendor->municipal_market_id
                ]);

                Notification::send($user, new UserCreatedNotification($password));
            });

            notyf()->position('y', 'top')->success('Vendor created successfully!');
            $this->dispatch('hide-create-vendor-modal');
            $this->dispatch('refresh-vendors');
        } catch (\Throwable $th) {
            report($th); // logs error for debugging
            notyf()->position('y', 'top')->error('Vendor could not be created!');
        }
    }

    public function showCreateVendorModal(){
        $this->reset(['name', 'email','contact_number']);
        $this->resetErrorBag();
        $this->dispatch('show-create-vendor-modal');
    }

    public function render()
    {
        return view('livewire.main.vendor.vendor-create');
    }
}
