<?php

namespace App\Models;

use Carbon\Carbon;
use InterventionImage;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The disk to save images to.
     *
     * @var string
     */
    protected $disk_name;

    /**
     * Takes a file from a HTTP request and will store it onto the disk.
     *
     * @param file $file
     *
     * @return string
     */
    public function saveWithFile($file)
    {
        $filename = md5($file->getClientOriginalName() . microtime()) . '.' . $file->getClientOriginalExtension();

        $date = Carbon::now('utc');

        $year = $date->year;
        $month = $date->month;
        $day = $date->day;

        Storage::disk($this->disk_name)->put($year.'/'.$month.'/'.$day.'/'.$filename, File::get($file));

        $prefix = Storage::disk($this->disk_name)->getDriver()->getAdapter()->getPathPrefix();
        $path = $year.'/'.$month.'/'.$day.'/'.$filename;

        $img = InterventionImage::make($prefix . $path)
            ->fit(1080, 1080)
            ->orientate()
            ->save();

        // Set properties to model
        $this->filename = $file->getClientOriginalName();
        $this->filepath = $path;
        $this->mime_type = $file->getClientMimeType();
        $this->save();

        return $path;
    }

    /**
     * Takes a disk name and file path to determine if it exists on the server.
     *
     * @param string $path
     *
     * @return boolean
     */
    public static function exists($path)
    {
        return Storage::disk($this->disk_name)->exists($path);
    }

    /**
     * Takes a disk name and file path and returns the associated file on the server
     *
     * @param string $path
     *
     * @return file
     */
    public static function get($path)
    {
        return Storage::disk($this->disk_name)->get($path);
    }

    /**
     * Delete the model.
     *
     * @return Boolean
     */
    public function delete()
    {
        Storage::disk($this->disk_name)->delete($this->filepath);

        return parent::delete();
    }

    /**
     * Retrieves an image using the filepath.
     *
     * @param \Illuminate\Database\Eloquent\QueryBuilder $query
     * @param string $filepath
     *
     * @return App\Models\Properties\Image | null
     */
    public static function scopeWhereFilePath($query, $filepath)
    {

        $path = ltrim(stripslashes(preg_replace('/'.$this->disk_name.'/', '', $filepath)), '/');
        return $query->where('filepath', $path);
    }
}
