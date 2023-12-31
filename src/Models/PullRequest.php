<?php

namespace Microit\DashboardModuleGit\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * @property int $id
 * @property string $source
 * @property string $title
 * @property int $number
 * @property string $state
 * @property string $repository_id
 * @property int $user_id
 * @property string $from_branch_id
 * @property string $to_branch_id
 * @property Repository $repository
 * @method static PullRequest create(array $array)
 * @method static Builder where(string $string, mixed $name)
 */
class PullRequest extends Model
{
    protected $table = 'git_pull_requests';

    public static string $staticSource = 'unknown';

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
            ->where('source', static::$staticSource)
            ->first();

        if (is_null($object)) {
            $object = self::create([
                'id' => $attributes['id'],
                'source' => static::$staticSource,
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

    public function fromBranch(): Branch
    {
        $branch = Branch::where('id', $this->from_branch_id)->where('repository_id', $this->repository_id)->first();
        if ($branch instanceof Branch) {
            return $branch;
        }

        throw new Exception('From branch not found for pull request: '.$this->id.' ('.$this->source.')');
    }

    public function toBranch(): Branch
    {
        $branch = Branch::where('id', $this->to_branch_id)->where('repository_id', $this->repository_id)->first();
        if ($branch instanceof Branch) {
            return $branch;
        }

        throw new Exception('To branch not found for pull request: '.$this->id.' ('.$this->source.')');
    }
}
