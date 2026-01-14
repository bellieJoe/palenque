<div>
    <x-page-header title="Notifications" />
    <div class="">
       @forelse ($notifications as $notification)
            <div class="alert alert-{{ $notification->data['type'] }} alert-dismissible fade show d-flex align-items-start mb-2" role="alert">
                <div class="flex-grow-1">
                    <h6 class="fw-bold mb-1">
                        <i class="fas fa-bell me-2"></i>
                        {{ $notification->data['title'] }}
                    </h6>
                    <p class="mb-0">
                        {{ $notification->data['message'] }}
                    </p>
                </div>

                <button type="button"
                        class="close"
                        aria-label="Close"
                        wire:click="deleteNotification('{{ $notification->id }}')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @empty
            <p class="text-muted">No notifications found</p>
        @endforelse
    </div>
</div>
