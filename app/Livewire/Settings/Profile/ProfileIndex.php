<?php

namespace App\Livewire\Settings\Profile;

use App\Models\Vendor;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

use function Flasher\Notyf\Prime\notyf;

class ProfileIndex extends Component
{
    use WithFileUploads;

    #[Validate('required|file|mimetypes:image/jpeg,image/png,application/pdf|max:2048')]
    public $businessPermit;
    #[Validate('required|file|mimetypes:image/jpeg,image/png,application/pdf|max:2048')]
    public $dtiPermit;
    public function render()
    {
        return view('livewire.settings.profile.profile-index');
    }

    public function saveBusinessPermit()
    {
        try {
            $this->validateOnly('businessPermit');
            $fileName = time() . '.' . $this->businessPermit->getClientOriginalExtension();
            $this->businessPermit->storeAs('business_permit', $fileName, 'public');
            Vendor::where('user_id', auth()->user()->id)->update([
                'business_permit' => $fileName
            ]);
            // notyf()->success('Business Permit Updated');
            return $this->redirect(request()->header('Referer'));
        } catch (\Throwable $th) {
            Log::error($th);
        }
        
    }

    public function saveDtiPermit()
    {
        try {
            $this->validateOnly('dtiPermit');
            $fileName = time() . '.' . $this->dtiPermit->getClientOriginalExtension();
            $this->dtiPermit->storeAs('dti_permit', $fileName, 'public');
            Vendor::where('user_id', auth()->user()->id)->update([
                'dti_permit' => $fileName
            ]);
            // notyf()->success('Business Permit Updated');
            return $this->redirect(request()->header('Referer'));
        } catch (\Throwable $th) {
            Log::error($th);
        }
        
    }
}
