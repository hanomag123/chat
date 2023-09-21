<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'chat_id',
      'message',
    ];

    public function user():BelongsTo{
      return $this->belongsTo(User::class);
    }
    public function chat():BelongsTo{
      return $this->belongsTo(Message::class);
    }
    public function scopeFilter(Builder $builder, QueryFilter $filter) {
      return $filter->apply($builder);
    }
}
