<?php

namespace App\Http\Controllers;

use DB;

/* Requests */
use Illuminate\Http\Request;
use App\Http\Requests\Companies\Update;

/* Models */
use App\Models\Companies\Company;
use App\Models\Companies\Image;

class CompaniesController extends Controller
{
    /**
     * Update a companies information.
     *
     * @param string $slug
     * @param App\Http\Requests\Companies\Update $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update($slug, Update $request)
    {
      return DB::transaction(function() use ($slug, $request) {
        $company = Company::where('slug', $slug)->firstOrFail();

        $company->fill($request->all());

        if ($request->hasFile('image')) {
          $image = new Image();
          $image->saveWithFile($request->image);
          $image->save();
          $company->image_id = $image->id;
          $company->save();
        } elseif (!$request->has('image')) {
          $image = $company->image;
          $company->image_id = null;
          $company->save();
          $image->delete();
        }

        return response()->json([
          'message' => 'Company Updated',
          'company' => $company
        ]);
      });
    }
}
