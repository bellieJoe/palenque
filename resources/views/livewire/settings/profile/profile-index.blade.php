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
                                <small>Name</small>
                                <p>{{ $vendor->contact_number }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
