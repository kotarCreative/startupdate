<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

      return view('users.edit')->with('user', $user);
    }
}
