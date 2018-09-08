<?php

namespace App\Http\Controllers;

/* Requests */
use Illuminate\Http\Request;
use App\Http\Requests\Companies\Update;

/* Models */
use App\Models\Companies\Company;

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
      $company = Company::where('slug', $slug)->firstOrFail();

      $company->fill($request->all());
      $company->save();

      return response()->json([
        'message' => 'Company Updated',
        'company' => $company
      ]);
    }
}
