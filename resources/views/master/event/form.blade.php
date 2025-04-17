@extends('layouts.app', [
    'activePage' => 'event.form',
    'title' => 'Form Event',
    'navName' => 'Event Management',
    'activeButton' => 'laravel',
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <a href="{{ url('event') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar Event</a>

        <div class="row justify-content-start">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ isset($event) ? 'Edit Event' : 'Tambah Event' }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('event/update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id_event" value="{{ old('id_event', $event->id_event ?? '') }}">

                            <div class="form-group">
                                <label>Nama Event</label>
                                <input type="text" name="nama_event" class="form-control" value="{{ old('nama_event', $event->nama_event ?? '') }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Deskripsi Event</label>
                                <textarea name="deskripsi_event" class="form-control" rows="3" required>{{ old('deskripsi_event', $event->deskripsi_event ?? '') }}</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Tanggal Event</label>
                                <input type="date" name="tanggal_event" class="form-control" value="{{ old('tanggal_event', isset($event) ? \Carbon\Carbon::parse($event->tanggal_event)->format('Y-m-d') : '') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Lokasi Event</label>
                                <input type="text" name="lokasi_event" class="form-control" value="{{ old('lokasi_event', $event->lokasi_event ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Jadwal Briefing</label>
                                <input type="datetime-local" name="jadwal_briefing" class="form-control"
                                    value="{{ old('jadwal_briefing', isset($event) ? \Carbon\Carbon::parse($event->jadwal_briefing)->format('Y-m-d\TH:i') : '') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Tipe Event</label>
                                <select name="tipe_event" class="form-control" required>
                                    <option value="">-- Pilih Tipe Event --</option>
                                    <option value="Pernikahan" {{ old('tipe_event', $event->tipe_event ?? '') == 'Pernikahan' ? 'selected' : '' }}>Pernikahan</option>
                                    <option value="Ulang Tahun" {{ old('tipe_event', $event->tipe_event ?? '') == 'Ulang Tahun' ? 'selected' : '' }}>Ulang Tahun</option>
                                    <option value="Company" {{ old('tipe_event', $event->tipe_event ?? '') == 'Company' ? 'selected' : '' }}>Company</option>
                                </select>
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
