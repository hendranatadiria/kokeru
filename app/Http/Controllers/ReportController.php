<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;
 
use PDF;

class ReportController extends Controller
{
    public function index()
    {
    	$report = Room::all();
    	return view('laporan',['report'=>$report]);
    }
 
    public function cetak_pdf()
    {
    	$report = Room::all();
 
    	$pdf = PDF::loadview('laporan_pdf',['report'=>$report]);
    	return $pdf->download('laporan-pdf.pdf');
    }
}
