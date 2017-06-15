<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Models\System\Member;
use App\Models\System\Plan;

class MemberController extends Controller
{
    public function index()
    {
    	$members = Member::all();
    	return view('frontend.member.index', compact('members'));
    }

    public function getData(Request $request)
    {
    	return Datatables::of(Member::query())
        // ->escapeColumns(['first_name', 'last_name', 'email'])
        // ->editColumn('confirmed', function ($user) {
        //     return $user->confirmed_label;
        // })
            ->make(true);
    }

    public function create(Request $request)
    {
        $plans = Plan::where('name', 'NOT LIKE', '%umum%')->get();
    	return view('frontend.member.form', compact('plans'));
    }

    public function store(Request $req)
    {
    	$m = new Member();
    	$m->rfid = $req->rfid;
    	$m->name = $req->name;
    	$m->address = $req->address;
    	$m->phone = $req->phone;
    	$m->member_type = $req->member_type;
    	if($m->save()){
    		return redirect()->route('frontend.member.index');
    	}else{
    		return redirect()->route('frontend.member.create');
    	}

    	return abort(404);
    }

    public function edit($id)
    {
    	$member = Member::find($id);
    	return view('frontend.member.edit', compact('member'));
    }

    public function update(Request $req, $id)
    {
    	$member = Member::find($id);
    	$member->rfid = $req->rfid;
    	$member->name = $req->name;
    	$member->address = $req->address;
    	$member->phone = $req->phone;
    	$member->member_type = $req->member_type;
    	if($member->save()){
    		return redirect()->route('frontend.member.index');
    	}else{
    		return redirect()->route('frontend.member.edit', ['id' => $id]);
    	}
    }

    public function destroy($id)
    {
    	$member = Member::find($id);
    	if($member->destroy($id))
    	{
    		return 'success';
    	}

    	abort(404);
    }
}
