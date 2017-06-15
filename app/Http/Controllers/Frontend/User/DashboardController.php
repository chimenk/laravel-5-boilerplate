<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\System\Ticket;
use App\Models\System\Member;
use Carbon\Carbon;
use Auth;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
    	$tickets = Ticket::all();
    	$sold = Ticket::where('created_at', '>', Auth::user()->updated_at)->get();
    	$member = Member::where('created_at', '>', Auth::user()->updated_at)->get();
        return view('frontend.user.dashboard', compact('tickets', 'sold', 'member'));
    }
}
