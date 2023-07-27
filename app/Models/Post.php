<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

//    protected $table = 'posts';
//    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
