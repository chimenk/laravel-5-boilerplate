<?php

namespace App\Http\Controllers\Frontend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Models\System\Plan;
use QrCode;
use Carbon\Carbon;

class TicketController extends Controller
{
    public function index()
    {
    	return view('frontend.ticket.index');
    }

    public function getData(Request $request)
    {
    	return Datatables::of(Plan::query())
            ->make(true);
    }

    public function price(Request $request)
    {
    	$plans = Plan::all();
    	return view('backend.ticket', compact('plans'));
    }

    public function TicketPrint(Request $req)
    {
    		$plan = Plan::where('name', 'umum')->first();
    		$qr = base64_encode(QrCode::format('png')->size(100)->generate('Make me into an QrCode!'));
    		$dt = Carbon::now();
    		// $tickets = Ticket::whereDate('created_at', $req->date)->get();
    		$html = '';
    		for ($i=0; $i < $req->jml; $i++) {
	    		$html .= '<h4 align=center>Tiket Masuk</h4>';
	    		$html .= '<center>Alamat<center><br>';
	    		$html .= '<center>'.$dt.'<center><br>';
	    		$html .= '<br><center>===============</center><br>';
	    		// $html .= $dt;
	    		$html .= '<img align="center" src="data:image/png;base64, '.$qr.'"><br>';
	    		$html .= '<br><center>===============<center><br>';
	    		$html .= '<center>Note: Pesan custom yang bisa disisipkan ke tiket</center>';
	    	}
    		$pdf = \App::make('dompdf.wrapper');
    		$pdf->loadHTML($html);
    		$pdf->save(public_path('s.pdf'));
    		return 'success';
    }

    public function create()
    {
    	return view('frontend.ticket.form');
    }

    public function store(Request $req)
    {
    	$plan = new Plan();
    	$plan->name = $req->name;
    	$plan->price = $req->price;
    	$plan->valid_for = $req->valid_for;
    	$plan->expired_at = $req->expired_at;
    	if($plan->save())
    	{
    		return redirect()->route('admin.ticket.price');
    	}
    }

    public function edit($id)
    {
    	$plan = Plan::find($id);
    	return view('frontend.ticket.edit', compact('plan'));
    }

    public function update(Request $req, $id)
    {
    	$plan = Plan::find($id);
    	$plan->name = $req->name;
    	$plan->price = $req->price;
    	$plan->valid_for = $req->valid_for;
    	$plan->expired_at = $req->expired_at;
    	if($plan->save()){
    		return redirect()->route('admin.ticket.price');
    	}

    	abort(404);
    }

    public function destroy($id)
    {
    	Plan::destroy($id);
    	return 'success';
    }
}
