<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'ordered_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function archive()
    {
        $this->delete();
    }

    public function refund()
    {
        $this->status = 'refunded';

        $this->save();
    }

    public function getAvatarAttribute()
    {
        return 'https://i.pravatar.cc/300?img='.((string) crc32($this->email))[0];
    }
}
