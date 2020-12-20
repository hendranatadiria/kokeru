<?php

namespace App\Http\Controllers;

/*
use App\Models\Kategori;
use App\Models\Komentar;
use App\Models\Post;
*/

use App\Models\Responsibility;
use App\Models\CleaningHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    //

    public function index() {
        //$post = Responsibility::orderByDesc('created_at')->get();
        //$id = auth()->user->id;
        $id = 1;
        $post = Responsibility::where('cleaning_service_id', $id)->get();
        //$tugasNotDone = CleaningHistory::where('cleaning_service_id', $id)->where('responsibility_id','!==', $tugasNotDone)->get();

        return view('cleaningservice.index', compact('post'));
    }

    public function lihatTugas($id) {
        $post = Responsibility::where('id', $id)->get();
        $komentar = Responsibility::where('idpost', $id)->get();

        $post = new CleaningHistory();
        $post->room_id = $request->input('room_id');
        $post->isipost = $request->input('cleaning_service_id');
        $post->idkategori = $request->input('responsibility_id');
        $post->idpenulis = Auth::guard('web')->user()->idpenulis;

        if ($request->hasFile('gambar_1')) {
            $gambar = $request->file('gambar_1');
            $fileName = time().$gambar->getClientOriginalName();

            if(!is_dir('img')) {
                mkdir('img', 0777, true);
            }
            $request->file('gambar')->move('img/', $fileName);

            $post->file_gambar = $fileName;
        }

        $post->save();

        return redirect()->back();

        return view('cleaningservice.singlepost', compact('post', 'komentar'));
    }

    /*
    [FUNGSI INDEX]
    public function index() {
        $post = Post::orderByDesc('created_at')->get();
        
        return view('cleaningservice.index', compact('post'));
    }
    */

    /*
    [FUNGSI LOOK ONE POST]
    public function lihatPost($id) {
        $post = Post::where('idpost', $id)->firstOrFail();
        $komentar = Komentar::where('idpost', $id)->get();

        return view('pengunjung.singlepost', compact('post', 'komentar'));
    }

    /*
    [FUNGSI LIST ALL]
    public function listPost() {
        $post = Kategori::all();
        //$variabel = [file php]:where (kalau dia melakukan CRUD)
        //$variabel = [file php]:all (buat get semua CRUD)

        return view('postlist', compact('post'));
    }

    /*
    [FUNGSI SEARCH]
    public function cariRuangan(Request $request){
        $post = Post::where('judul', 'like', '%'.$request->q.'%')->orWhere('isipost', 'like', '%'.$request->q.'%')->get();

        return view('search', compact('post'));
    }
    */

    /*
    [FUNGSI STORE]
    public function updateStatus(Request $request, $id){
        $komentar = new Komentar();
        $komentar->idpost = $id;
        $komentar->idpenulis = Auth::guard('web')->user()->idpenulis;
        $komentar->isi = $request->isikomentar;
        $komentar->save();

        return redirect()->back();

    }
    */

    /*
    [FUNGSI DELETE]
    public function deleteKomentar($id){
        $komentar = Komentar::where('idkomentar', $id)->firstOrFail();
        if ($komentar->post->idpenulis == Auth::guard('web')->user()->idpenulis) {
            $komentar->delete();
        }

        return redirect()->back();
    }
    */
}
