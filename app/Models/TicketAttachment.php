<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TicketAttachment extends Model implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes, HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
          'file_path' => 'json',
      ];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('ticket_reward')->useDisk('public');
    }
    public function ticketreward()
    {
        return $this->belongsTo(Ticket::class,'ticket_id');
    }
}
