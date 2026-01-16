<div>
    @php
        $vendor = auth()->user()->vendor;
    @endphp
    <x-page-header title="Profile" />
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-2">
                        <img src="https://api.dicebear.com/9.x/identicon/svg?seed={{ auth()->user()->name }}" alt="user" class="rounded-circle" width="200">
                    </div>
                    <h3 class="text-center">{{ auth()->user()->name }}</h3>
                    @foreach (auth()->user()->roles as $role)
                        <p class="text-muted text-center mb-0">{{ $role->roleType->name }}</p>
                    @endforeach
                </div>
            </div>
        </div>
        @if (auth()->user()->isVendor())
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 >Vendor Information</h4>
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <small>Vendor Name</small>
                                <p>{{ $vendor->name }}</p>
                            </div>
                            <div class="col-12 col-lg-4">
                                <small>Name</small>
                                <p>{{ $vendor->representative_name }}</p>
                            </div>
                            <div class="col-12 col-lg-4">
                                <small>Contact Number</small>
                                <p>{{ $vendor->contact_number }}</p>
                            </div>
                            <div class="col-12 col-lg-4">
                                <small>Products Sold</small>
                                <p>{{ $vendor->product_type == "BOTH" ? "WET & DRY" : $vendor->product_type }}</p>
                            </div>
                        </div>
                        <h4 >Attachments</h4>
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <small>Business/Mayor's Permit</small>
                                <p>
                                    <a href="{{ Storage::url('business_permit/'.$vendor->business_permit) }}" target="_blank">
                                        Click to View
                                    </a>
                                    <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#uploadBusinessPermitModal"><i class="fa-regular fa-pen-to-square"></i></button>
                                </p>
                            </div>
                            <div class="col-12 col-lg-4">
                                <small>DTI Permit</small>
                                <p>
                                    <a href="{{ Storage::url('dti_permit/'.$vendor->dti_permit) }}" target="_blank">
                                        Click to View
                                    </a>
                                    <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#uploadDtiPermitModal" ><i class="fa-regular fa-pen-to-square"></i></button>
                                </p>
                            </div>
                            <div class="col-12 col-lg-4">
                                <small>BIR Registration</small>
                                <p>
                                    <a href="{{ Storage::url('bir_registration/'.$vendor->bir_registration) }}" target="_blank">
                                        Click to View
                                    </a>
                                    <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#uploadBirRegistrationModal" ><i class="fa-regular fa-pen-to-square"></i></button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div id="uploadBusinessPermitModal" class="modal fade" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Business Permit</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Business Permit</label>
                        <input type="file"
                            class="form-control"
                            accept=".pdf,.jpg,.png"
                            wire:model.live="businessPermit">
                        @error('businessPermit') <span class="text-danger">{{ $message }}</span> @enderror
                        <div wire:loading wire:target="businessPermit">Uploading...</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="saveBusinessPermit" wire:loading.attr="disabled">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div id="uploadDtiPermitModal" class="modal fade" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload DTI Permit</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>DTI Permit</label>
                        <input type="file"
                            class="form-control"
                            accept=".pdf,.jpg,.png"
                            wire:model.live="dtiPermit">
                        @error('dtiPermit') <span class="text-danger">{{ $message }}</span> @enderror
                        <div wire:loading wire:target="dtiPermit">Uploading...</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="saveDtiPermit" wire:loading.attr="disabled">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div id="uploadBirRegistrationModal" class="modal fade" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload BIR Registration</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>BIR Registration</label>
                        <input type="file"
                            class="form-control"
                            accept=".pdf,.jpg,.png"
                            wire:model.live="birRegistration">
                        @error('birRegistration') <span class="text-danger">{{ $message }}</span> @enderror
                        <div wire:loading wire:target="birRegistration">Uploading...</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="saveBirRegistration" wire:loading.attr="disabled">Save</button>
                </div>
            </div>
        </div>
    </div>

</div>
