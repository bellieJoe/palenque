<?php

namespace App\Livewire\Vendor\Notifications;

use Livewire\Component;

class NotificationIndex extends Component
{
    public function deleteNotification($id){
        auth()->user()
        ->notifications()
        ->where('id', $id)
        ->first()
        ?->markAsRead();
    }

    public function render()
    {
        $notifications = auth()->user()
            ->unreadNotifications()
            ->latest()
            ->paginate(10);
        return view('livewire.vendor.notifications.notification-index',[
            'notifications' => $notifications
        ]);
    }
}
