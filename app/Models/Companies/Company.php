<?php

namespace App\Models\Companies;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vertical_id',
        'company_progress_type_id',
        'name',
        'url',
        'email',
        'city',
        'country',
        'description',
        'from_startup_school'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * One to many relationship on the images table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
      return $this->belongsTo('App\Models\Companies\Image');
    }

    /**
     * Attach the companies current image to the model.
     *
     * @return void
     */
    public function attachImage()
    {
      $image = $this->image()->first();
      if ($image) {
        $this->image = '/' . env('COMPANY_IMAGE_DISK') . '/' . $image->filepath;
      }
    }

    /**
     * One to many relationship on the progress_updates table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function progressUpdates()
    {
      return $this->hasMany('App\Models\Companies\Progress\Update')->orderBy('created_at', 'desc');
    }

    /**
     * One to many relationship on the verticals table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function vertical()
    {
      return $this->belongsTo('App\Models\Companies\Vertical');
    }

    /**
     * One to many relationship on the company_progress_types table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function progressType()
    {
      return $this->belongsTo('App\Models\Companies\Progress\Type', 'company_progress_type_id');
    }
}
