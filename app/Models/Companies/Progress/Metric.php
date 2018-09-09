<?php

namespace App\Models\Companies\Progress;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    /**
     * The table the model is associated to.
     *
     * @var $table
     */
    protected $table = 'progress_metrics';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];
}
