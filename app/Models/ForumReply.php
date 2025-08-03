<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ForumReply
 *
 * @property int $id
 * @property int $forum_discussion_id
 * @property int $user_id
 * @property int|null $parent_reply_id
 * @property string $content
 * @property array|null $attachments
 * @property bool $is_solution
 * @property int $likes_count
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ForumDiscussion $forumDiscussion
 * @property-read \App\Models\User $user
 * @property-read \App\Models\ForumReply|null $parentReply
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ForumReply> $childReplies
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ForumReply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumReply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumReply query()
 * @method static \Database\Factories\ForumReplyFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class ForumReply extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'forum_discussion_id',
        'user_id',
        'parent_reply_id',
        'content',
        'attachments',
        'is_solution',
        'likes_count',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'attachments' => 'array',
        'is_solution' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the forum discussion that owns the forum reply.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forumDiscussion(): BelongsTo
    {
        return $this->belongsTo(ForumDiscussion::class);
    }

    /**
     * Get the user that created the forum reply.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent reply.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentReply(): BelongsTo
    {
        return $this->belongsTo(ForumReply::class, 'parent_reply_id');
    }

    /**
     * Get the child replies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childReplies(): HasMany
    {
        return $this->hasMany(ForumReply::class, 'parent_reply_id');
    }
}