@extends('layouts.app', [
    'activePage' => 'detail_events.detail',
    'title' => 'Detail Event',
    'navName' => 'Detail Event',
    'activeButton' => 'laravel',
])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <a href="javascript:history.back()" class="btn btn-secondary mb-3">&larr; Kembali</a>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center"
                    role="alert" style="padding-right: 3rem;">
                    <div>
                        <strong>Sukses!</strong> {{ session('success') }}
                    </div>
                    <button type="button" class="close ml-3" data-dismiss="alert" aria-label="Close"
                        style="position: absolute; right: 1rem;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Crew Terlibat</h4>
                            @if($event->status == 'pre-event')
                                <a href="{{ url('detailEvents/form/' . $event->id_event) }}" class="btn btn-primary btn-sm">+
                                    Tambah Crew</a>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Crew</th>
                                            <th>Level</th>
                                            <th>Jobdesk</th>
                                            <th>Catatan</th>
                                            <th>Addons</th>
                                            <th>Durasi Addons</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($crewList as $index => $crew)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $crew->nama_lengkap }}</td>
                                                <td>{{ $crew->level }}</td>
                                                <td>{{ $crew->nama_jobdesk }}</td>
                                                <td>{{ $crew->notes ?? '-' }}</td>
                                                <td>{{ $crew->isAddons ? 'Ya' : 'Tidak' }}</td>
                                                <td>{{ $crew->durasiAddons ?? '-' }}</td>
                                                <td>
                                                    @if($event->status == 'pre-event')
                                                        <a href="{{ url('detailEvents/form/' . $event->id_event . '_' . $crew->id_detail_event) }}"
                                                            class="btn btn-warning btn-sm">Edit</a>
                                                        <form
                                                            action="{{ url('detailEvents/delete/' . $event->id_event . '_' . $crew->id_detail_event) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Yakin ingin menghapus crew ini?')">Delete</button>
                                                        </form>
                                                    @else
                                                        <span class="badge badge-secondary">Locked</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4 class="card-title">{{ $event->nama_event }}</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Deskripsi:</strong><br>{{ $event->deskripsi_event }}</p>
                            <p><strong>Lokasi:</strong><br>{{ $event->lokasi_event }}</p>
                            <p><strong>Tanggal Event:</strong><br>{{ \Carbon\Carbon::parse($event->tanggal_event)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($event->tanggal_closing)->translatedFormat('d F Y') }}</p>
                            <p><strong>Jadwal Briefing:</strong><br>{{ \Carbon\Carbon::parse($event->jadwal_briefing)->translatedFormat('d F Y H:i') }}</p>
                            <p><strong>Tipe Event:</strong><br>{{ $event->tipe_event }}</p>
                            <p><strong>Status:</strong><br>{{ ucfirst($event->status) }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
