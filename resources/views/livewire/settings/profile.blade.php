<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<div class="container-fluid">
    <section class="w-100">
        @include('partials.settings-heading')
        <br>
        {{-- <div class="card">
            <div class="card-body"> --}}
        <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
            <form wire:submit="updateProfileInformation" class="my-4 w-100">
                
                {{-- Name Input --}}
                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input 
                        wire:model="name" 
                        type="text" 
                        class="form-control" 
                        id="name" 
                        required 
                        autofocus 
                        autocomplete="name"
                    >
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
    
                {{-- Email Input --}}
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input 
                        wire:model="email" 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        required 
                        autocomplete="email"
                    >
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
    
                    @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                        <div class="mt-3">
                            <p class="text-muted mb-1">{{ __('Your email address is unverified.') }}</p>
                            <a 
                                href="#" 
                                class="text-sm text-primary" 
                                wire:click.prevent="resendVerificationNotification"
                            >
                                {{ __('Click here to re-send the verification email.') }}
                            </a>
    
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 text-success font-weight-bold">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
    
                {{-- Submit Button --}}
                <div class="d-flex align-items-center mt-4">
                    <button 
                        type="submit" 
                        class="btn btn-primary" 
                        data-test="update-profile-button"
                    >
                        {{ __('Save') }}
                    </button>
    
                    <x-action-message class="ml-3" on="profile-updated">
                        {{ __('Saved.') }}
                    </x-action-message>
                </div>
            </form>
    
            {{-- Delete User Form --}}
            {{-- <livewire:settings.delete-user-form /> --}}
        </x-settings.layout>
            {{-- </div>
        </div> --}}
    </section>
</div>
