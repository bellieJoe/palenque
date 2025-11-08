<div>
    <x-page-header title="Violations" />
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <a class="btn btn-sm btn-outline-secondary border-0" href="{{ route('main.violations.index') }}" wire:navigate><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>&nbsp;&nbsp;
                <h5 class="card-title">Vendor Violations</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="border p-3 mb-3">
                <div class="row">
                    <div class="col-lg-4 mb-2">
                        <label class="small mb-0 text-muted">Vendor</label>
                        <div>{{ $vendor->name }}</div>
                    </div>
                    <div class="col-lg-4 mb-2">
                        <label class="small mb-0 text-muted">Representative</label>
                        <div>{{ $vendor->representative_name }}</div>
                    </div>
                    <div class="col-lg-4 mb-2">
                        <label class="small mb-0 text-muted">Contact Number</label>
                        <div>{{ $vendor->contact_number }}</div>
                    </div>
                    <div class="col-lg-4 mb-2">
                        <label class="small mb-0 text-muted">Email</label>
                        <div>{{ $vendor->user->email }}</div>
                    </div>
                </div>
            </div>
            <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Violation...">
            <div class="table-responsive">
                <table class="table table-hovered" style="min-width: 1000px">
                    <thead>
                        <th>Violation</th>
                        <th>Penalty</th>
                        <th>Date Issued</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($violations as $violation)
                            <tr>
                                <td class="align-middle">{{ $violation->violationType->name }}</td>
                                <td class="align-middle">{{ $violation->violationType->penalty_type == 'MONETARY' ? 'Php ' . number_format($violation->violationType->monetary_penalty, 2, '.', ',') : $violation->violationType->service_penalty }}</td>
                                <td class="align-middle">{{ $violation->created_at->format('M d, Y') }}</td>
                                <td class="align-middle"><span class="badge badge-{{ $violation->status == 'RESOLVED' ? 'success' : ($violation->status == 'WAIVED' ? 'warning' : 'secondary') }}">{{ $violation->status }}</span></td>
                                <td class="align-middle">
                                    @if ($violation->status == "PENDING")
                                        <button class="btn btn-outline-primary" wire:click="waiveViolation({{$violation->id}})" wire:confirm="Are you sure you want to waive this violation?">Waive</button>
                                        <button class="btn btn-outline-primary" wire:click="resolveViolation({{$violation->id}})" wire:confirm="Are you sure you want to resolve this violation?">Resolve</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No Violations Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $violations->links() }}
            </div>
        </div>
    </div>
</div>
