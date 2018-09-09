<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProgressUpdates\Create;
use App\Http\Requests\ProgressUpdates\Update;

/* Models */
use App\Models\Companies\Company;
use App\Models\Companies\Progress\Update as ProgressUpdate;

class ProgressUpdatesController extends Controller
{
    /**
     * Create a progress update in the system.
     *
     * @param string $slug
     * @param App\Http\Requests\ProgressUpdates\Create $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug, Create $request)
    {
      $company = Company::where('slug', $slug)->firstOrFail();

      $progress_update = ProgressUpdate::make($request->all());
      $progress_update->company_id = $company->id;
      $progress_update->save();
      $progress_update->attachMetric();

      return response()->json([
        'message' => 'Progress Update Created.',
        'progress_update' => $progress_update
      ]);
    }

    /**
     * Update an existing progress update in the system.
     *
     * @param string $slug
     * @param App\Models\Companies\Progress\Update $progress_update
     * @param App\Http\Requests\ProgressUpdates\Update $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update($slug, ProgressUpdate $progress_update, Update $request)
    {
      $company = Company::where('slug', $slug)->firstOrFail();

      if ($company->id != $progress_update->company_id && $company->user_id != Auth::user()->id) {
        abort(403);
      }

      $progress_update->fill($request->all());
      $progress_update->save();
      $progress_update->attachMetric();

      return response()->json([
        'message' => 'Progress Update Updated.',
        'progress_update' => $progress_update
      ]);
    }
}
