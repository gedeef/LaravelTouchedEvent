<?php
namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;

/**
 * extends from Relation
 */
class BelongsToWithTouch extends BelongsTo
{
	public function touch(){
		$model = $this->getRelated();
        if (! $model::isIgnoringTouch()) {
            $this->rawUpdate([
                $model->getUpdatedAtColumn() => $model->freshTimestampString(),
            ]);
        }
        $model->fireModelEvent('touched', false);
	}
}
