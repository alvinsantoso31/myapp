<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CrewController extends Controller
{

    public function index()
    {
        $data['crew'] = DB::table('crew')->get();
        return view('master.crew.index', $data);
    }

    public function form($id)
    {
        $data = [];
        if ($id['id'] != '-') {
            $data['crew'] = DB::table('crew')->where('id_crew', $id)->first();
        }
        // dd($data);
        return view('master.crew.form', $data);
    }

    public function update()
    {
        $validated = request()->validate([
            'nama_lengkap' => 'required|string|max:100',
            'no_telp' => 'required|string|max:15',
            'jabatan' => 'required|in:HRD,Crew,Admin,Finance',
            'tanggal_lahir' => 'required|date',
            'level' => 'required|in:junior,intermediate,senior',
        ]);

        if (empty(request()->id_crew)) {
            DB::table('crew')->insert(array_merge($validated, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
            return redirect('crew')->with('success', 'Data crew berhasil ditambahkan!');
        } else {
            DB::table('crew')->where('id_crew', request()->id_crew)->update(array_merge($validated, [
                'updated_at' => now(),
            ]));
            return redirect('crew')->with('success', 'Data crew berhasil diupdate!');
        }
    }

    public function delete($id)
    {
        DB::table('crew')->where('id_crew', $id)->delete();

        return redirect('crew')->with('success', 'Data crew berhasil dihapus.');
    }
}
