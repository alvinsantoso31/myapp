@extends('layouts.app', [
    'activePage' => 'jobdesk.form',
    'title' => 'Form Jobdesk',
    'navName' => 'Master Jobdesk',
    'activeButton' => 'laravel',
])

@section('content')
<div class="content">
    <div class="container-fluid">
        <a href="{{ url('jobdesk') }}" class="btn btn-secondary mb-3">← Kembali</a>

        <div class="row justify-content-start">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ isset($jobdesk) ? 'Edit' : 'Tambah' }} Jobdesk</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('jobdesk/update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id_jobdesk" value="{{ old('id_jobdesk', $jobdesk->id_jobdesk ?? '') }}">

                            <div class="form-group">
                                <label>Nama Jobdesk</label>
                                <input type="text" name="nama_jobdesk" class="form-control"
                                    value="{{ old('nama_jobdesk', $jobdesk->nama_jobdesk ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi', $jobdesk->deskripsi ?? '') }}</textarea>
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
