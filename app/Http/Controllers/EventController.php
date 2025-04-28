<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        $data['event'] = DB::table('events')->orderBy('tanggal_event', 'desc')->get();
        return view('master.event.index', $data);
    }

    public function form($id)
    {
        $data = [];
        if ($id['id'] != '-') {
            $data['event'] = DB::table('events')->where('id_event', $id['id'])->first();
        }
        return view('master.event.form', $data);
    }

    public function update()
    {
        $validated = request()->validate([
            'nama_event' => 'required|string|max:100',
            'deskripsi_event' => 'required|string',
            'tanggal_event' => 'required|date',
            'tanggal_closing' => 'required|date',
            'lokasi_event' => 'required|string|max:100',
            'jadwal_briefing' => 'required|date_format:Y-m-d\TH:i',
            'tipe_event' => 'required|string|max:50',
        ]);

        if (empty(request()->id_event)) {
            DB::table('events')->insert(array_merge($validated, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
            return redirect('detailEvents')->with('success', 'Event berhasil ditambahkan!');
        } else {
            DB::table('events')->where('id_event', request()->id_event)->update(array_merge($validated, [
                'updated_at' => now(),
            ]));
            return redirect('detailEvents')->with('success', 'Event berhasil diperbarui!');
        }
    }

    public function delete($id)
    {
        DB::table('events')->where('id_event', $id)->delete();
        return redirect('detailEvents')->with('success', 'Event berhasil dihapus.');
    }
}
