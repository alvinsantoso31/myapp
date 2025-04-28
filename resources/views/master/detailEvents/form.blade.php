@extends('layouts.app', [
    'activePage' => 'detail_events.index',
    'title' => 'Form Detail Event',
    'navName' => 'Detail Events',
    'activeButton' => 'laravel',
])

@section('content')
<div class="content">
    <div class="container-fluid">
        <a href="javascript:history.back()" class="btn btn-secondary mb-3">&larr; Kembali</a>

        <div class="row justify-content-start">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ isset($detailEvent) ? 'Edit' : 'Tambah' }} Detail Event</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('detailEvents/update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id_detail_event" value="{{ old('id_detail_event', $detailEvent->id_detail_event ?? '') }}">
                            <input type="hidden" name="id_event" value="{{ old('id_event', $idevent ?? '') }}">

                            <div class="form-group">
                                <label>Crew</label>
                                <select name="id_crew" class="form-control" required>
                                    <option value="">-- Pilih Crew --</option>
                                    @foreach ($crews as $crew)
                                        <option value="{{ $crew->id_crew }}" {{ old('id_crew', $detailEvent->id_crew ?? '') == $crew->id_crew ? 'selected' : '' }}>{{ $crew->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Jobdesk</label>
                                <select name="id_jobdesk" class="form-control" required>
                                    <option value="">-- Pilih Jobdesk --</option>
                                    @foreach ($jobdesks as $jobdesk)
                                        <option value="{{ $jobdesk->id_jobdesk }}" {{ old('id_jobdesk', $detailEvent->id_jobdesk ?? '') == $jobdesk->id_jobdesk ? 'selected' : '' }}>{{ $jobdesk->nama_jobdesk }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Catatan</label>
                                <textarea name="notes" class="form-control" rows="2">{{ old('notes', $detailEvent->notes ?? '') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Tambahan (Addons)</label>
                                <select name="isAddons" class="form-control">
                                    <option value="0" {{ old('isAddons', $detailEvent->isAddons ?? 0) == 0 ? 'selected' : '' }}>Tidak</option>
                                    <option value="1" {{ old('isAddons', $detailEvent->isAddons ?? 0) == 1 ? 'selected' : '' }}>Ya</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Durasi Addons (Menit)</label>
                                <input type="number" name="durasiAddons" class="form-control" value="{{ old('durasiAddons', $detailEvent->durasiAddons ?? '') }}">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
