<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TouchRelation;

class ModelWithTouch extends Model{

	protected $observables = ['touched'];

    /*
     * extends from Illuminate\Database\Eloquent\Relations\Relation
     */
    public static function touched($callback)
    {
        static::registerModelEvent('touched', $callback);
    }

    /**
     * extends from Illuminate\Database\Eloquent\Concerns\HasRelationships
     * can be done for all relations if necessary
     */
    protected function newBelongsTo(\Illuminate\Database\Eloquent\Builder $query, \Illuminate\Database\Eloquent\Model $child, $foreignKey, $ownerKey, $relation)
    {
        //Log::info('will return a new TouchRelation');
        return new BelongsToWithTouch($query, $child, $foreignKey, $ownerKey, $relation);
    }


    /**
     * extends from Illuminate\Database\Eloquent\Concerns\HasEvents
     * to make it public, so that the model can run it
     */
    public function fireModelEvent($event, $halt = true){
        return parent::fireModelEvent($event, $halt);
    }
}
