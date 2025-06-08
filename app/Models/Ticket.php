<?php

namespace App\Models;

use Filament\Forms\Components\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    use InteractsWithMedia;
    //
    use SoftDeletes, HasFactory;
    protected $guarded = ['id'];

    public function types():BelongsToMany
    {
        return $this->belongsToMany(Type::class,'ticket_types');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('ticket_media')->useDisk('public');
        // ->addMediaConversion('thumb')->nonQueued();
    }

    public function messages()
    {
        return $this->hasMany(TicketMassage::class);
    }

    public function user(): BelongsTo
    {
    return $this->belongsTo(User::class, 'user_id');
    }

    public function users(): BelongsTo
    {
    return $this->belongsTo(User::class);
    }

    public function agents(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function useragen(): HasOne
    {
        return $this->hasOne(User::class,'id','agent_id');
    }


}
