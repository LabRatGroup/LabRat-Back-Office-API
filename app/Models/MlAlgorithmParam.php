<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int    $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property mixed  $algorithm
 */
class MlAlgorithmParam extends BaseEntity
{
    protected $fillable = [
        'name',
        'description',
        'key',
        'range',
        'step',
    ];

    /**
     * @return BelongsTo
     */
    public function algorithm()
    {
        return $this->belongsTo(MlAlgorithm::class);
    }
}
