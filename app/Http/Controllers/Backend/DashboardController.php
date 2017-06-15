<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\System\Ticket;
use App\Models\System\Member;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $ticket = Ticket::whereDate('created_at', Carbon::now()->toDateString())->get();
        $member = Member::whereDate('created_at', Carbon::now()->toDateString())->get();
        $allm = Member::all();
        return view('backend.dashboard', compact('ticket', 'member', 'allm'));
    }

    public function report()
    {
    	return view('backend.report');
    }

    public function reporting(Request $req)
    {
    	if($req->tipe == 1){
    		$tickets = Ticket::whereDate('created_at', $req->date)->get();
    		$html = '<h2 align="center">Laporan Penjualan Tiket</h2>';
    		$html .= '<br><center>Tanggal :'.$req->date.'</center>';
    		$html .= '<table width=100% border=1>';
    		$html .= '<thead>';
    		$html .= '<tr><th>No</th><th>No. Tiket</th><th>Tipe</th><th>Harga</th><th>Waktu Cetak</th></tr>';
    		$html .= '</thead>';
    		$html .= '<tbody>';
    		$n = 1;
    		foreach ($tickets as $ticket) {
    			$html .= '<tr><td>'.$n++.'</td><td>'.$ticket->ticket_no.'</td><td>'.$ticket->type.'</td><td>Rp. '.number_format($ticket->price).'</td><td>'.$ticket->created_at->format('H:i:s').'</td></tr>';
    		}
    		$html .= '</tbody>';
    		$html .= '</table>';

    		$pdf = \App::make('dompdf.wrapper');
    		$pdf->loadHTML($html);
    		$pdf->save(public_path('r.pdf'));
    		return 'success';
    	}
    }
}
