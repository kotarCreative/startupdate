<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProgressUpdates\Update;

/* Models */
use App\Models\Companies\Company;
use App\Models\Companies\Progress\Update as ProgressUpdate;

class ProgressUpdatesController extends Controller
{
    /**
     * Update an existing progress update in the system.
     *
     * @param integer $id
     * @param App\Http\Requests\ProgressUpdates\Update $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Company $company, ProgressUpdate $progress_update, Update $request)
    {
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
