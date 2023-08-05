<?php

namespace Microit\DashboardModuleGit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * @property int $id
 * @property string $title
 * @property int $number
 * @property string $state
 * @property string $repository_id
 * @property int $user_id
 * @property string $from_branch_id
 * @property string $to_branch_id
 * @property Repository $repository
 * @property Branch $from_branch
 * @property Branch $to_branch
 * @method static PullRequest create(array $array)
 * @method static Builder where(string $string, mixed $name)
 */
class PullRequest extends Model
{
    protected $table = 'git_pull_requests';

    public static string $source = 'unknown';

    public $incrementing = false;

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'id',
        'source',
        'title',
        'number',
        'state',
        'repository_id',
        'user_id',
        'from_branch_id',
        'to_branch_id',
    ];

    protected $attributes = [
        'source' => 'unknown',
    ];

    /**
     * @param array{
     *     id: int,
     *     title: string,
     *     number: int,
     *     state: string,
     *     repository_id: string,
     *     user_id: int,
     *     from_branch_id: string,
     *     to_branch_id: string,
     * } $attributes
     * @return self
     */
    public static function fromAttributes(array $attributes): self
    {
        /** @var PullRequest|null $object */
        $object = self::where('id', $attributes['id'])
            ->where('source', static::$source)
            ->first();

        if (is_null($object)) {
            $object = self::create([
                'id' => $attributes['id'],
                'source' => static::$source,
                'title' => $attributes['title'],
                'number' => $attributes['number'],
                'state' => $attributes['state'],
                'repository_id' => $attributes['repository_id'],
                'user_id' => $attributes['user_id'],
                'from_branch_id' => $attributes['from_branch_id'],
                'to_branch_id' => $attributes['to_branch_id'],
            ]);
        }

        return $object;
    }

    public function repository(): BelongsTo
    {
        return $this->belongsTo(Repository::class);
    }

    public function fromBranch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function toBranch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
