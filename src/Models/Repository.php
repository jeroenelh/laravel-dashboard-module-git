<?php

namespace Microit\DashboardModuleGit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @property string $id
 * @property string $source
 * @property string $user
 * @property string $name
 * @property bool $is_public
 * @method static Repository create(array $array)
 * @method static Builder where(string $string, mixed $name)
 */
class Repository extends Model
{
    protected $table = 'git_repositories';

    public static string $staticSource = 'unknown';

    public $incrementing = false;

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'id',
        'source',
        'user',
        'name',
        'is_public',
    ];

    protected $attributes = [
        'source' => 'unknown',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    /**
     * @param array{
     *     id: string,
     *     user: string,
     *     name: string,
     *     is_public: bool,
     * } $attributes
     * @return self
     */
    public static function fromAttributes(array $attributes): self
    {
        /** @var Repository|null $object */
        $object = self::where('id', $attributes['id'])
                    ->where('source', static::$staticSource)
                    ->first();

        if (is_null($object)) {
            $object = self::create([
                'id' => $attributes['id'],
                'source' => static::$staticSource,
                'user' => $attributes['user'],
                'name' => $attributes['name'],
                'is_public' => $attributes['is_public'],
            ]);
        }

        return $object;
    }
}
