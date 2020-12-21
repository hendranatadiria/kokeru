<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Room;
use App\Models\Responsibility;
use App\Models\CleaningHistory;
use App\Models\CleaningService;


class CleaningServiceController extends Controller
{
    //
    public function editTugas($id){
        $data = Responsibility::where('id', $id)->firstOrFail();

        return view('cleaningservice.editsingletugas', compact('data'));
    }

    public function simpanTugas(Request $request){
        $post = new CleaningHistory();
        $post->responsibility_id = $request->input('id');
        $post->cleaning_service_id = $request->input('cs_id');
        $post->room_id = $request->input('room_id');

        if ($request->hasFile('prove_1')) {
            $gambar = $request->file('prove_1');
            $fileName = time().$gambar->getClientOriginalName();

            if(!is_dir('img')) {
                mkdir('img', 0777, true);
            }
            $request->file('prove_1')->move('prove_1/', $fileName);

            $post->file_gambar = $fileName;
        }

        if ($request->hasFile('prove_2')) {
            $gambar = $request->file('prove_2');
            $fileName = time().$gambar->getClientOriginalName();

            if(!is_dir('img')) {
                mkdir('img', 0777, true);
            }
            $request->file('prove_2')->move('prove_2/', $fileName);

            $post->file_gambar = $fileName;
        }

        if ($request->hasFile('prove_3')) {
            $gambar = $request->file('prove_3');
            $fileName = time().$gambar->getClientOriginalName();

            if(!is_dir('img')) {
                mkdir('img', 0777, true);
            }
            $request->file('prove_3')->move('prove_3/', $fileName);

            $post->file_gambar = $fileName;
        }
        $post->save();

        return redirect('/');
    }

    public function updateTugas(Request $request, $id){
        $post =  Post::where('idpost', $id)->firstOrFail();
        if($post->idpenulis == Auth::guard('web')->user()->idpenulis) {
            $post->judul = $request->input('judul');
            $post->isipost = $request->input('isipost');

            $post->save();

        }

        return redirect('/tugas/'.$post->idpost)->with('success', 'Tugas berhasil diupdate');
    }

}
