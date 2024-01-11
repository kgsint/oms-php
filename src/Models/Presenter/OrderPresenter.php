<?php 

namespace App\Models\Presenter;

class OrderPresenter
{
    public static function present(string|int $status): string
    {
        return match($status) {
            STATUS_PENDING => '<span style="font-size: 12px;" class="px-2 py-1 alert alert-secondary rounded-3 text-secondary fw-bold">Pending</span>',
            STATUS_SHIPPED => '<span style="font-size: 12px;" class="px-2 py-1 alert alert-warning text-secondary rounded-3 border border-1 fw-bold">Shipped</span>',
            STATUS_DELIVERED => '<span style="font-size: 12px;" class="px-2 py-1 alert alert-success rounded-3 text-secondary fw-bold">Delivered</span>',
            STATUS_CANCELLED => '<span style="font-size: 12px;" class="px-2 py-1 alert alert-danger rounded-3 text-secondary fw-bold">Cancelled</span>',
        };
    }
}