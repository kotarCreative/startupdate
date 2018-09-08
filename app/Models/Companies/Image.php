<?php

namespace App\Models\Companies;

use App\Models\Image as ParentImage;

class Image extends ParentImage
{
  public function __construct()
  {
    $this->disk_name = env('COMPANY_IMAGE_DISK');
  }
}
