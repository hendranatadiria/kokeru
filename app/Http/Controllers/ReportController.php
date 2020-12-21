<?php

namespace App\Http\Controllers;

use App\Models\CleaningHistory;
use App\Models\Responsibility;
use Illuminate\Http\Request;

use App\Models\Room;
use Carbon\Carbon;
use PDF;

class ReportController extends Controller
{
    public function index(Request $request)
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

    public function add($id)
    {
        $today = Carbon::now()->toDateString();
        $csid = backpack_user()->cleaning_services_id;
        $respo = Responsibility::where('cleaning_service_id', $csid)->where('room_id', $id)->where('assigned_from', '<=', $today)->where('assigned_to', '>=', $today)->firstOrFail();

        $room = Room::findOrFail($id);
        return view('laporan_tambah', compact('room', 'respo'));

    }

    public function store(Request $request, $id)
    {
        $today = Carbon::now()->toDateString();
        $csid = backpack_user()->cleaning_services_id;
        $respo = Responsibility::where('cleaning_service_id', $csid)->where('room_id', $id)->where('assigned_from', '<=', $today)->where('assigned_to', '>=', $today)->firstOrFail();

        if ($request->hasFile('proof1')) {
            $uploadePhoto = $request->file('proof1');
            $photoname = time().$uploadePhoto->getClientOriginalName();
            $destinationPath = $uploadePhoto->move('public/upload/proof/', $photoname);

            $request['proof_1'] = $photoname;
        }

        if ($request->hasFile('proof2')) {
            $uploadePhoto = $request->file('proof2');
            $photoname = time().$uploadePhoto->getClientOriginalName();
            $destinationPath = $uploadePhoto->move('public/upload/proof/', $photoname);

            $request['proof_2'] = $photoname;
        }
        if ($request->hasFile('proof3')) {
            $uploadePhoto = $request->file('proof3');
            $photoname = time().$uploadePhoto->getClientOriginalName();
            $destinationPath = $uploadePhoto->move('public/upload/proof/', $photoname);

            $request['proof_3'] = $photoname;
        }
        if ($request->hasFile('proof4')) {
            $uploadePhoto = $request->file('proof4');
            $photoname = time().$uploadePhoto->getClientOriginalName();
            $destinationPath = $uploadePhoto->move('public/upload/proof/', $photoname);

            $request['proof_4'] = $photoname;
        }
        if ($request->hasFile('proof5')) {
            $uploadePhoto = $request->file('proof5');
            $photoname = time().$uploadePhoto->getClientOriginalName();
            $destinationPath = $uploadePhoto->move('public/upload/proof/', $photoname);

            $request['proof_5'] = $photoname;
        }

        $request['room_id'] = $id;
        $request['cleaning_service_id'] = $csid;
        $request['cleaning_service_id'] = backpack_user()->cleaning_services_id;
        $request['responsibility_id'] = $respo->id;

        CleaningHistory::create($request->all());


        \Alert::add('success', 'Laporan pembersihan telah berhasil ditambahkan')->flash();
        return redirect('/admin/dashboard');
    }


      public function getJson($id)
      {
        return CleaningHistory::with('cleaningService')->findOrFail($id);
      }
}
