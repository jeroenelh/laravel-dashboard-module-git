<?php

namespace Microit\DashboardModuleGit\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @property string $id
 * @property string $source
 * @property string $state
 * @property int $pull_request_id
 * @property int $user_id
 * @property Carbon $submitted_at
 * @method static PullRequestApprove create(array $array)
 * @method static Builder where(string $string, mixed $name)
 */
class PullRequestApprove extends Model
{
    protected $table = 'git_pull_request_approves';

    public static string $source = 'unknown';

    public $incrementing = false;

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'id',
        'source',
        'state',
        'pull_request_id',
        'user_id',
        'submitted_at',
    ];

    protected $attributes = [
        'source' => 'unknown',
    ];

    /**
     * @param array{
     *     id: string,
     *     state: string,
     *     pull_request_id: int,
     *     user_id: int,
     *     submitted_at: Carbon,
     * } $attributes
     * @return self
     */
    public static function fromAttributes(array $attributes): self
    {
        /** @var PullRequestApprove|null $object */
        $object = self::where('id', $attributes['id'])
            ->where('source', static::$source)
            ->first();

        if (is_null($object)) {
            $object = self::create([
                'id' => $attributes['id'],
                'source' => static::$source,
                'state' => $attributes['state'],
                'pull_request_id' => $attributes['pull_request_id'],
                'user_id' => $attributes['user_id'],
                'submitted_at' => $attributes['submitted_at'],
            ]);
        }

        return $object;
    }
}
