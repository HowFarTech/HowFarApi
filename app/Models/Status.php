<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Status extends Model
{
    use HasFactory;
    protected $table="statuses";
    protected $fillable = [
    'senderUid',
    'serverTime',
    'storageLink',
    'statusType',
    'caption',
    'timeSent',
    'imageUri',
    'videoUri',
    'senderPhone',
    'isAdmin',
    'captionBackgroundColor',
    'statusDeliveryType',
    ];

    /**
     * Get the user that owns the Status
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'senderUid', 'id');
    }
}
