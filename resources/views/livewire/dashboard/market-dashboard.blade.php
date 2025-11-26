<div>
    @if (auth()->user()->isMarketSupervisor() || auth()->user()->isMarketSpecialist() || auth()->user()->isAdminAide() || auth()->user()->isMarketInspector())
    <div class="d-flex justify-content-center mb-4">
        <div class="form-inline mr-2">
            <label for="">From &nbsp;&nbsp;&nbsp;</label>
            <input type="date" class="form-control" wire:model.live="startFilter">
        </div>
        <div class="form-inline">
            <label for="">To &nbsp;&nbsp;&nbsp;</label>
            <input type="date" class="form-control" wire:model.live="endFilter">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <i class="fa-solid fa-users font-20 text-purple"></i>
                            <p class="font-16 m-b-5">Users</p>
                        </div>
                        <div class="col-5">
                            <h1 class="font-light text-right mb-0">{{ number_format($userCount, 0, '.', ',') }}</h1>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <i class="fa-solid fa-building-wheat font-20 text-danger"></i>
                            <p class="font-16 m-b-5">Public Markets</p>
                        </div>
                        <div class="col-5">
                            <h1 class="font-light text-right mb-0">{{ number_format($marketCount, 0, '.', ',') }}</h1>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <i class="fa-solid fa-user-tag font-20 text-info"></i>
                            <p class="font-16 m-b-5">Vendors</p>
                        </div>
                        <div class="col-5">
                            <h1 class="font-light text-right mb-0">{{ number_format($vendorCount, 0, '.', ',') }}</h1>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <i class="fa-solid fa-boxes-packing font-20 text-success"></i>
                            <p class="font-16 m-b-5">Suppliers</p>
                        </div>
                        <div class="col-5">
                            <h1 class="font-light text-right mb-0">{{ number_format($supplierCount, 0, '.', ',') }}</h1>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
    </div>
    @endif
</div>