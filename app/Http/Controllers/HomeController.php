<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Companies\Progress\Type as ProgressType;
use App\Models\Companies\Vertical;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $progress_types = ProgressType::all();
        $verticals = Vertical::all();

        return view('home', compact('progress_types', 'verticals'));
    }

    /**
     * Show the feedback page.
     *
     * @return \Illuminate\Http\Response
     */
    public function feedback()
    {

    }
}
