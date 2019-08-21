<?php
/**
 * Created by PhpStorm.
 * User: sierraf
 * Date: 2/19/2019
 * Time: 9:56 AM
 */

namespace App\Models\OSM;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OSM\Relation
 *
 * @property int $id
 * @property int $changeset_id
 * @property int $visible
 * @property string $timestamp
 * @property int $version
 * @property int $uid
 * @property string $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OSM\RelationMember[] $members
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OSM\RelationTag[] $tags
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OSM\Relation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OSM\Relation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OSM\Relation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OSM\Relation whereChangesetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OSM\Relation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OSM\Relation whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OSM\Relation whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OSM\Relation whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OSM\Relation whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OSM\Relation whereVisible($value)
 * @mixin \Eloquent
 */
class Relation extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'changeset_id',
        'visible',
        'timestamp',
        'version',
        'user'
    ];

    public function tags()
    {
        return $this->hasMany(RelationTag::class);
    }

    public function nodes()
    {
        return $this->morphedByMany(Node::class, "member", RelationMember::class);
    }

    public function ways()
    {
        return $this->morphedByMany(Way::class, "member", RelationMember::class);
    }

    public function relations()
    {
        return $this->morphedByMany(Relation::class, "member", RelationMember::class);
    }
}
