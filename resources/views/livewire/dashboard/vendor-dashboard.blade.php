<div>
    @if (auth()->user()->isVendor())
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
                                <p class="font-16 m-b-5">Stalls</p>
                            </div>
                            <div class="col-5">
                                <h1 class="font-light text-right mb-0">0</h1>
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
                                <i class="fa-solid fa-users font-20 text-purple"></i>
                                <p class="font-16 m-b-5">Ambulant Stalls</p>
                            </div>
                            <div class="col-5">
                                <h1 class="font-light text-right mb-0">0</h1>
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>
        </div>
    @endif
</div>
