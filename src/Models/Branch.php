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
        'name',
        'user',
        'source',
        'repository_id',
    ];

    protected $attributes = [
        'source' => 'unkown',
    ];

    public static function fromAttributes(array $attributes): self
    {
        /** @var Branch|null $object */
        $object = self::where('name', $attributes['name'])
                    ->where('user', $attributes['user'])
                    ->where('source', static::$source)
                    ->first();

        if (is_null($object)) {
            $object = self::create([
                'name' => $attributes['name'],
                'user' => $attributes['user'],
                'source' => static::$source,
                'repository_id' => $attributes['repository_id'],
            ]);
        }

        return $object;
    }
}
