<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.user');
    }

    public function update_user(Request $request)
    {   
        $validatedData = $request->validate([
            'foto' => ['nullable', 'image', 'file', 'max:1024'],
            'name' => ['required'],
            'jenis_kelamin' => ['nullable'],
            'tanggal_lahir' => ['nullable', 'date'],
            'umur' => ['nullable', 'integer'],
            'tinggi' => ['nullable', 'integer'],
            'berat' => ['nullable', 'integer'],
            'nohp' => ['nullable'],
            'pendidikan' => ['nullable'],
            'hobi' => ['nullable'],
            'alamat' => ['nullable'],
            'motivasi' => ['nullable']
        ]);
        
        if($request->file('foto')) {
            if($request->input('oldFoto')) {
                Storage::delete($request->input('oldFoto'));
            }

            $validatedData['foto'] = $request->file('foto')->store('user-images');
        }

        if($request->input('username')) {
            User::where('username', $request->input('username'))->update($validatedData);

            return redirect('/')->with('flash', [
                'status' => 'success',
                'message' => 'Update User Success'
            ]);
        }
       
        return redirect('/')->with('flash', [
            'status' => 'error',
            'message' => '!!!Username Is Lost '
        ]);
    }

    public function insert(Request $request)
    {
        $rows = 1;

        if($request->has('rows')) {
            if(is_numeric($request->query('rows'))) {
                if($request->query('rows') <= 3 && $request->query('rows') >= 1) {   
                    $rows = $request->query('rows');
                } 
            }
        }

        return view('dashboard.insert', [
            'rows' => $rows
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'murid.*.user' => ['required'],
            'murid.*.foto' => ['nullable', 'image', 'file', 'max:1024'],
            'murid.*.nis' => ['required', 'min:3', 'max:10', 'unique:murids,nis'],
            'murid.*.nisn' => ['required', 'min:5', 'max:15', 'unique:murids,nisn'],
            'murid.*.name' => ['required'],
            'murid.*.agama_id' => ['required'],
            'murid.*.gender_id' => ['required'],
            'murid.*.anak_ke' => ['nullable'],
            'murid.*.tempat_lahir' => ['nullable'],
            'murid.*.tanggal_lahir' => ['nullable'],
            'murid.*.umur' => ['nullable', 'integer'],
            'murid.*.tinggi' => ['nullable', 'integer'],
            'murid.*.berat' => ['nullable', 'integer'],
            'murid.*.nohp' => ['nullable'],
            'murid.*.alamat' => ['nullable'],
            'murid.*.catatan_untuk_murid' => ['nullable'],
        ]); 

        // --------digunakan untuk mengecek nis duplikat saat insert--------
        $buffer_nis = [];
        for($i = 0; $i < count($validatedData['murid']); $i++) {
            array_push($buffer_nis, $validatedData['murid'][$i]['nis']);
        }
        if(count(array_unique($buffer_nis)) !== count($buffer_nis)) {
            return redirect('/insert')->with('flash', [
                'status' => 'error',
                'message' => 'nis duplikat'
            ]);
        }
        // --------digunakan untuk mengecek nis duplikat saat insert--------

        // --------digunakan untuk mengecek nisn duplikat saat insert--------
        $buffer_nisn = [];
        for($i = 0; $i < count($validatedData['murid']); $i++) {
            array_push($buffer_nisn, $validatedData['murid'][$i]['nisn']);
        }
        if(count(array_unique($buffer_nisn)) !== count($buffer_nisn)) {
            return redirect('/insert')->with('flash', [
                'status' => 'error',
                'message' => 'nisn duplikat'
            ]);
        }
        // --------digunakan untuk mengecek nisn duplikat saat insert--------

        for ($i = 0; $i < count($validatedData['murid']); $i++) { 
            if($request->file("murid.$i.foto")) {
                $validatedData['murid'][$i]['foto'] = $request->file("murid.$i.foto")->store($request->input('folder_image'));
            }
        }

        for ($i = 0; $i < count($validatedData['murid']); $i++) {  
            if($request->input("murid.$i.user")) {
                Murid::create($validatedData['murid'][$i]);

                if($i === count($validatedData['murid']) - 1) {
                    return redirect("/list")->with('flash', [
                        'status' => 'success',
                        'message' => 'Insert Murid Success'
                    ]);
                }
            }
        }
       
        return redirect('/')->with('flash', [
            'status' => 'error',
            'message' => '!!!Username Is Lost '
        ]);
    }

    public function list()
    {
        return view('dashboard.list', [
            'murids' => Murid::where('user', auth()->user()->username)->paginate(3)
        ]);
    }

    public function search(Request $request)
    {
        if($request->ajax()) {
            return view('dashboard.search-result', [
                'murids' => Murid::query()->filter(['username' => auth()->user()->username , 'search' => $request->search])->get()
            ]);
        }
    }

    public function edit(Murid $murid, Request $request)
    {
        return view('dashboard.edit', [
            'murid' => $murid,
            'page' => $request->query('page')
        ]); 
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'foto' => ['nullable', 'image', 'file', 'max:1024'],
            'nis' => ['required', 'min:3', 'max:10'],
            'nisn' => ['required', 'min:5', 'max:15'],
            'name' => ['required'],
            'agama_id' => ['required'],
            'gender_id' => ['required'],
            'anak_ke' => ['nullable'],
            'tempat_lahir' => ['nullable'],
            'tanggal_lahir' => ['nullable'],
            'umur' => ['nullable', 'integer'],
            'tinggi' => ['nullable', 'integer'],
            'berat' => ['nullable', 'integer'],
            'nohp' => ['nullable'],
            'alamat' => ['nullable'],
            'catatan_untuk_murid' => ['nullable'],
        ]);

        $oldMurid = Murid::where('nis', $request->input('old_nis'))->first();

        if($validatedData['nis'] !== $oldMurid->nis) {
            if(Murid::where('nis', $validatedData['nis'])->count()) {
                return redirect("/list/edit/" . $request->input('old_nis'))->with('flash', [
                    'status' => 'error',
                    'message' => 'nis sudah ada yang pakai'
                ]);
            }
        }

        if($validatedData['nisn'] !== $oldMurid->nisn) {
            if(Murid::where('nisn', $validatedData['nisn'])->count()) {
                return redirect("/list/edit/" . $request->input('old_nis'))->with('flash', [
                    'status' => 'error',
                    'message' => 'nisn sudah ada yang pakai'
                ]);
            }
        }

        if($request->file('foto')) {
            if($oldMurid->foto) {
                Storage::delete($oldMurid->foto);
            }

            $validatedData['foto'] = $request->file('foto')->store($request->input('folder_image'));
        }

        Murid::where('nis', $request->input('old_nis'))->update($validatedData);

        return redirect("/list?page=" . $request->input('page'))->with('flash', [
            'status' => 'success',
            'message' => 'Edit Murid Success'
        ]);
    }

    public function delete(Request $request)
    {
        if($request->input('nis')) {
            $murid = Murid::where('nis', $request->input('nis'))->first();
            
            if($murid) {
                if($murid->foto) {
                    Storage::delete($murid->foto);
                }

                $murid->delete();
                
                return redirect("/list")->with('flash', [
                    'status' => 'success',
                    'message' => 'Delete Murid Success'
                ]);
            }
        }

        return redirect('/')->with('flash', [
            'status' => 'error',
            'message' => '!!!NIS Is Lost'
        ]);
    }
}
