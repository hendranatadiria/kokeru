<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Responsibility;
use App\Models\CleaningHistory;
use App\Models\CleaningService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CleaningServiceController extends Controller
{
    //
    public function editTugas($id){
        $data = Post::where('idpost', $id)->firstOrFail();

        if ($data->idpenulis == Auth::guard('web')->user()->idpenulis) {

            return view('cleaningservice.editsingletugas', compact('data'));
        }
        return redirect('/tugas/'.$id);

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
