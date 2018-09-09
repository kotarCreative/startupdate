<?php

namespace App\Models\Companies\Progress;

use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    /**
     * The table the model is associated to.
     *
     * @var $table
     */
    protected $table = 'progress_updates';

    /**
     * Attach the updates metric to the model.
     *
     * @return void
     */
    public function attachMetric()
    {
        $metric = $this->metric()->first();
        if ($metric->slug === 'other') {
          $this->metric = $this->other_metric;
        } else {
          $this->metric = $metric->name;
        }
    }

    /**
     * One to many relationship on the progress_metrics table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function metric()
    {
        return $this->belongsTo('App\Models\Companies\Progress\Metric', 'progress_metric_id');
    }
}
