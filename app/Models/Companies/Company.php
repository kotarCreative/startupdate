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
}
