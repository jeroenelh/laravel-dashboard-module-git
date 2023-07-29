<?php

namespace Microit\DashboardModuleGit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @method static Repository create(array $array)
 * @method static Builder where(string $string, mixed $name)
 */
class Repository extends Model
{
    protected $table = 'git_repositories';

    public const SOURCE = 'unknown';

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'id',
        'source',
        'name',
        'is_public',
    ];

    protected $attributes = [
        'source' => 'unkown',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public static function fromAttributes(array $attributes): self
    {
        /** @var Repository|null $object */
        $object = self::where('id', $attributes['id'])
                    ->where('source', get_called_class()::SOURCE)
                    ->first();

        if (is_null($object)) {
            $object = self::create([
                'id' => $attributes['id'],
                'source' => get_called_class()::SOURCE,
                'name' => $attributes['name'],
                'is_public' => $attributes['is_public'],
            ]);
        }

        return $object;
    }
}
