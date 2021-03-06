<?php

namespace App\Http\Controllers;

use DB;
use Auth;

/* Requests */
use Illuminate\Http\Request;
use App\Http\Requests\Companies\Search;
use App\Http\Requests\Companies\Update;

/* Models */
use App\Models\Companies\Company;
use App\Models\Companies\Image;

class CompaniesController extends Controller
{
    /**
     * Create a new company in the system.
     *
     * @param string $slug
     * @param App\Http\Requests\Companies\Update $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Update $request)
    {
        return DB::transaction(function() use ($request) {
            $company = Company::create($request->all());
            if ($request->hasFile('image')) {
              $image = new Image();
              $image->saveWithFile($request->image);
              $image->save();
              $company->image_id = $image->id;
              $company->save();
            }

            Auth::user()->companies()->attach($company);

            $company->attachImage();

            return response()->json([
              'message' => 'Company Created.',
              'company' => $company
            ]);
        });
    }

    /**
     * Search for companies.
     *
     * @param App\Http\Requests\Companies\Search $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Search $request)
    {
        $query = Company::select('*');

        if ($request->has('filter')) {
            if ($request->filter == 'startup-school') {
                $query->where('from_startup_school', true);
            }
        }

        if ($request->has('vertical')) {
            $query->where('vertical_id', $request->vertical);
        }

        if ($request->has('progress')) {
            $query->where('company_progress_type_id', $request->progress);
        }

        if ($request->has('term')) {
            switch ($request->type) {
                case 'company':
                    $query->whereRaw("name LIKE '$request->term%'");
                    break;
                case 'location':
                    $query->where(function($innerQuery) use ($request) {
                        $innerQuery->whereRaw("city LIKE '$request->term%'")
                            ->orWhereRaw("country LIKE '$request->term%'");
                    });
                    break;
            }
        }

        $companies = $query->orderBy('name', 'asc')->paginate(20);

        foreach ($companies as $company) {
            $company->vertical;
            $company->progressType;
            $company->attachImage();
        }

        return $companies;
    }

    /**
     * Show a companies profile.
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $company->vertical;
        $company->progressType;
        $company->attachImage();

        foreach ($company->progressUpdates as $update) {
          $update->attachMetric();
        }

        return view('companies/show', compact('company'));
    }

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
          if ($image) {
              $company->image_id = null;
              $company->save();
              $image->delete();
          }
        }

        $company->save();
        return response()->json([
          'message' => 'Company Updated',
          'company' => $company
        ]);
      });
    }
}
