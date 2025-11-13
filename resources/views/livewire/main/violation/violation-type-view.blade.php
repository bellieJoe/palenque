<div>
    <x-page-header title="Violation Types" />
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <a class="btn btn-sm btn-outline-secondary border-0" href="{{ route('main.violations.types.index') }}" wire:navigate><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>&nbsp;&nbsp;
                <h5 class="card-title">Violation Type Details</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 mb-2">
                    <label class="small mb-0 text-muted">Name</label>
                    <div>{{ $violationType->name }}</div>
                </div>
                <div class="col-lg-4 mb-2">
                    <label class="small mb-0 text-muted">Code</label>
                    <div>{{ $violationType->code }}</div>
                </div>
                <div class="col-lg-4 mb-2">
                    <label class="small mb-0 text-muted">Penalty Type</label>
                    <div class="">
                        <span class="badge rounded-pill badge-{{ $violationType->penalty_type ? 'info' : 'warning' }}">{{ $violationType->penalty_type }}</span>
                    </div>
                </div>
                @if ($violationType->penalty_type == "MONETARY")
                    <div class="col-lg-4 mb-2">
                        <label class="small mb-0 text-muted">Penalty Amount</label>
                        <div>{{ $violationType->monetary_penalty }}</div>
                    </div>
                @endif
                @if ($violationType->penalty_type == "SERVICE")
                    <div class="col mb-2">
                        <label class="small mb-0 text-muted">Penalty Service</label>
                        <div>{{ $violationType->service_penalty }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
