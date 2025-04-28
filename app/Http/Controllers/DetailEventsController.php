<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DetailEventsController extends Controller
{
    public function index()
    {
        $events = DB::table('events')
            ->orderBy('tanggal_event', 'asc')
            ->get();

        return view('master.detailEvents.index', compact('events'));
    }

    public function form($id)
    {
        $detailEvent = null;
        $crews = DB::table('crew')->orderBy('nama_lengkap')->get();
        $jobdesks = DB::table('job_desks')->orderBy('nama_jobdesk')->get();

        if (str_contains($id['id'], '_')) {
            [$idevent, $idDetailEvent] = explode('_', $id['id']);
            $detailEvent = DB::table('detail_events')->where('id_detail_event', $idDetailEvent)->first();
        } else {
            $idevent = $id['id'];
        }

        return view('master.detailEvents.form', compact('detailEvent', 'crews', 'jobdesks', 'idevent'));
    }

    public function detail($id)
    {
        $event = DB::table('events')->where('id_event', $id)->first();

        $crewList = DB::table('detail_events')
            ->join('crew', 'detail_events.id_crew', '=', 'crew.id_crew')
            ->join('job_desks', 'detail_events.id_jobdesk', '=', 'job_desks.id_jobdesk')
            ->where('detail_events.id_event', $id)
            ->select(
                'crew.nama_lengkap',
                'crew.level',
                'job_desks.nama_jobdesk',
                'detail_events.notes',
                'detail_events.*'
            )
            ->get();

        return view('master.detailEvents.detail', compact('event', 'crewList'));
    }

    public function update()
    {
        $validated = request()->validate([
            'id_crew' => 'required|exists:crew,id_crew',
            'id_event' => 'required|exists:events,id_event',
            'id_jobdesk' => 'required|exists:job_desks,id_jobdesk',
            'notes' => 'nullable|string',
            'isAddons' => 'nullable|boolean',
            'durasiAddons' => 'nullable|integer',
        ]);

        if (empty(request()->id_detail_event)) {
            DB::table('detail_events')->insert(array_merge($validated, [
                
                'created_at' => now(),
                'updated_at' => now(),
            ]));

            return redirect('detailEvents/detail/'.$validated['id_event'])->with('success', 'Detail Event berhasil ditambahkan!');
        } else {
            DB::table('detail_events')->where('id_detail_event', request()->id_detail_event)->update(array_merge($validated, [
                'updated_at' => now(),
            ]));

            return redirect('detailEvents/detail/'.$validated['id_event'])->with('success', 'Detail Event berhasil diupdate!');
        }
    }

    public function delete($id)
    {

        [$idevent, $idDetailEvent] = explode('_', $id['id']);
        DB::table('detail_events')->where('id_detail_event', $idDetailEvent)->delete();

        return redirect('detailEvents/detail/'.$idevent)->with('success', 'Detail Event berhasil dihapus.');
    }
}
