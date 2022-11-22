<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    public const PUBLIC_STATUS = 0;
    public const PRIVATE_STATUS = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'is_private'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function isPrivate(): bool
    {
        return $this->is_private === self::PRIVATE_STATUS;
    }

    public static function getAvailableStatuses()
    {
        $postStatuses = [
            [
                'label' => 'Public',
                'value' => self::PUBLIC_STATUS
            ],
            [
                'label' => 'Private',
                'value' => self::PRIVATE_STATUS
            ]
        ];

        return $postStatuses;
    }
}
