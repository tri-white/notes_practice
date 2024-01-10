<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Notes extends Model
{
    use HasFactory;
    protected $fillable = [
            //can be mass assigned
        "text",
    ];
    protected $hidden = [
        //  hidden elements dont show when parsing eloqModel to JSON
        
    ];
    protected $guarded = [
        // guarding from mass alignment. user_id gets changed only when saving note
        'user_id', // 
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
