<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RulePenggajianController extends Controller
{
    public function index()
    {
        $rules = DB::table('rule_penggajian')
            ->join('job_desks', 'rule_penggajian.id_jobdesk', '=', 'job_desks.id_jobdesk')
            ->select('rule_penggajian.*', 'job_desks.nama_jobdesk')
            ->orderByDesc('rule_penggajian.timestamp')
            ->get();

        return view('master.rulePenggajian.index', compact('rules'));
    }

    public function form($id)
    {
        $rule = null;
        $jobdesks = DB::table('job_desks')->get();

        if ($id['id'] != '-') {
            $rule = DB::table('rule_penggajian')->where('id_rule_penggajian', $id['id'])->first();
        }

        return view('master.rulePenggajian.form', compact('rule', 'jobdesks'));
    }

    public function update()
    {
        $validated = request()->validate([
            'nama_rule' => 'required|string|max:100',
            'level' => 'required|in:junior,intermediate,senior',
            'id_jobdesk' => 'required|exists:job_desks,id_jobdesk',
            'lokasi' => 'required|string|max:100',
            'tipe_event' => 'required|string|max:50',
            'isAddons' => 'required|boolean',
            'gaji_minimal' => 'required|integer|min:0',
            'gaji_perjam' => 'required|integer|min:0',
            'timestamp' => 'required|date_format:Y-m-d\TH:i',
        ]);

        if (empty($request->id_rule_penggajian)) {
            DB::table('rule_penggajian')->insert(array_merge($validated, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));

            return redirect('rulePenggajian')->with('success', 'Rule berhasil ditambahkan!');
        } else {
            DB::table('rule_penggajian')->where('id_rule_penggajian', request()->id_rule_penggajian)->update(array_merge($validated, [
                'updated_at' => now(),
            ]));

            return redirect('rulePenggajian')->with('success', 'Rule berhasil diperbarui!');
        }
    }

    public function delete($id)
    {
        DB::table('rule_penggajian')->where('id_rule_penggajian', $id)->delete();
        return redirect('rulePenggajian')->with('success', 'Rule berhasil dihapus.');
    }
}
