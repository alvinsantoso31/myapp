<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JobDeskController extends Controller
{
    public function index()
    {
        $jobdesks = DB::table('job_desks')->orderBy('nama_jobdesk')->get();
        return view('master.jobdesk.index', compact('jobdesks'));
    }

    public function form($id)
    {
        $jobdesk = null;
        if ($id['id'] != '-') {
            $jobdesk = DB::table('job_desks')->where('id_jobdesk', $id['id'])->first();
        }

        return view('master.jobdesk.form', compact('jobdesk'));
    }

    public function update()
    {
        $validated = request()->validate([
            'nama_jobdesk' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:255',
        ]);

        if (empty(request()->id_jobdesk)) {
            DB::table('job_desks')->insert(array_merge($validated, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));

            return redirect('jobdesk')->with('success', 'Jobdesk berhasil ditambahkan!');
        } else {
            DB::table('job_desks')->where('id_jobdesk', request()->id_jobdesk)->update(array_merge($validated, [
                'updated_at' => now(),
            ]));

            return redirect('jobdesk')->with('success', 'Jobdesk berhasil diupdate!');
        }
    }

    public function delete($id)
    {
        DB::table('job_desks')->where('id_jobdesk', $id)->delete();
        return redirect('jobdesk')->with('success', 'Jobdesk berhasil dihapus.');
    }
}
