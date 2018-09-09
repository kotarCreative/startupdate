<?php

namespace App\Http\Controllers;

use Hash;

/* Requests */
use Illuminate\Http\Request;
use App\Http\Requests\Users\Update;

/* Models */
use App\Models\User;
use App\Models\Companies\Progress\Metric;
use App\Models\Companies\Progress\Type as ProgressType;
use App\Models\Companies\Vertical;

class UsersController extends Controller
{
    /**
     * Edit a users profile
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
      $user = User::where('slug', $slug)->firstOrFail();
      $company = $user->companies()->first();
      $company->attachImage();
      $company->progressUpdates;

      foreach ($company->progressUpdates as $update) {
        $update->attachMetric();
      }

      // Additional Metrics
      $metrics = Metric::all();
      $progress_types = ProgressType::all();
      $verticals = Vertical::all();
      return view('users.edit', compact('user', 'company', 'metrics', 'progress_types', 'verticals'));
    }

    /**
     * Update a users profile information.
     *
     * @param string $slug
     * @param App\Http\Requests\Users\Update $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update($slug, Update $request)
    {
      $user = User::where('slug', $slug)->firstOrFail();
      if (!$request->current_password || !Hash::check($request->current_password, $user->password)) {
        return response()->json([
          'errors' => [
            'current_password' => [ 'This does not match your current password.' ],
            'message' => 'The given data was invalid.'
          ]
        ], 422);
      }

      $user->first_name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->email = $request->email;

      if ($request->has('password')) {
        $user->password = bcrypt($request->password);
      }

      $user->save();

      return response()->json([
        'message' => 'Profile Updated',
        'profile' => $user
      ]);
    }
}
