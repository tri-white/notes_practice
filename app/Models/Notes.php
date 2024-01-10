<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Notes extends Model
{
    use HasFactory;
    protected $fillable = [
        "text",
        'user_id',
    ];
    protected $hidden = [
        // no hidden elements. hidden elements dont show when parsing eloqModel to JSON
    ];
    protected $guarded = [
        // no guarded elements. there is nothing that can be exploited for external batch attacks in this model... or I am too naive
    ];
   /**
     * Get the user that owns the Notes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
