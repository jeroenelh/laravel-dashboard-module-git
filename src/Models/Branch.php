<?php

namespace Microit\DashboardModuleGit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @method static Branch create(array $array)
 * @method static Builder where(string $string, mixed $name)
 */
class Branch extends Model
{
    protected $table = 'git_branches';

    public static string $source = 'unknown';

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
                    ->where('source', static::$source)
                    ->first();

        if (is_null($object)) {
            $object = self::create([
                'id' => $attributes['id'],
                'source' => static::$source,
                'user' => $attributes['user'],
                'name' => $attributes['name'],
                'repository_id' => $attributes['repository_id'],
            ]);
        }

        return $object;
    }
}
