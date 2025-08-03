<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ForumDiscussion
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $content
 * @property string $category
 * @property array|null $tags
 * @property int $views_count
 * @property int $replies_count
 * @property \Illuminate\Support\Carbon|null $last_activity
 * @property bool $is_pinned
 * @property bool $is_locked
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ForumReply> $replies
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ForumDiscussion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumDiscussion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumDiscussion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumDiscussion active()
 * @method static \Database\Factories\ForumDiscussionFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class ForumDiscussion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'category',
        'tags',
        'views_count',
        'replies_count',
        'last_activity',
        'is_pinned',
        'is_locked',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tags' => 'array',
        'is_pinned' => 'boolean',
        'is_locked' => 'boolean',
        'last_activity' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the forum discussion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the replies for the forum discussion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(ForumReply::class);
    }

    /**
     * Scope a query to only include active discussions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}