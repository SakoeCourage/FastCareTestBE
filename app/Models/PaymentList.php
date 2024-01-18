<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class PaymentList extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function amount(): Attribute
    {
        return Attribute::make(
            get: fn ($amount) => $amount / 100,
            set: fn ($amount) => $amount * 100
        );
    }

    public function mode()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('subscriber', 'Like', '%' . $search . '%');
        })->when($filters['sort'] ?? false, function ($query, $sort) {
            if ($sort == 'created_asc') {
                $query->orderBy('created_at', 'asc');
            } else if ($sort == 'created_desc') {
                $query->orderBy('created_at', 'desc');
            }
        })->when($filters['start_date'] ?? false, function ($query, $filter) {
            $query->whereDate('created_at', '>=', Carbon::createFromFormat("d/m/Y",$filter) );
        })->when($filters['end_date'] ?? false, function ($query, $filter) {
            $query->whereDate('created_at', '<=', Carbon::createFromFormat("d/m/Y",$filter));
        })->when($filters['status'] ?? false, function ($query, $status) {
            if ($status == 'paid') {
                $query->where('status', 'paid');
            } else if ($status == 'pending') {
                $query->where('status', 'pending');
            }
        });
    }
}
