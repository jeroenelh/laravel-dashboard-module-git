<?php

namespace Microit\DashboardModuleGit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @property string $id
 * @property string $source
 * @property string $user
 * @property string $name
 * @property int $repository_id
 * @method static Branch create(array $array)
 * @method static Builder where(string $string, mixed $name)
 */
class Branch extends Model
{
    protected $table = 'git_branches';

    public static string $staticSource = 'unknown';

    public $incrementing = false;

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'id',
        'source',
        'user',
        'name',
        'repository_id',
    ];

    protected $attributes = [
        'source' => 'unknown',
    ];

    /**
     * @param array{
     *     id: string,
     *     user: string,
     *     name: string,
     *     repository_id: int,
     * } $attributes
     * @return self
     */
    public static function fromAttributes(array $attributes): self
    {
        /** @var Branch|null $object */
        $object = self::where('id', $attributes['id'])
                    ->where('source', static::$staticSource)
                    ->first();

        if (is_null($object)) {
            $object = self::create([
                'id' => $attributes['id'],
                'source' => static::$staticSource,
                'user' => $attributes['user'],
                'name' => $attributes['name'],
                'repository_id' => $attributes['repository_id'],
            ]);
        }

        return $object;
    }
}
