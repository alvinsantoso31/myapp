@extends('layouts.app', [
    'activePage' => 'crew.index',
    'title' => 'Data Crew',
    'navName' => 'Crew Management',
    'activeButton' => 'laravel',
])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <a href="{{ url('crew') }}" class="btn btn-secondary mb-3">← Kembali ke Data Crew</a>

            <div class="row justify-content-start">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ isset($crew) ? 'Edit Crew' : 'Tambah Crew' }}</h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form action="{{ url('crew/update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id_crew" value="{{ old('id_crew', $crew->id_crew ?? '') }}">

                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control"
                                        value="{{ old('nama_lengkap', $crew->nama_lengkap ?? '') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>No Telp</label>
                                    <input type="text" name="no_telp" class="form-control"
                                        value="{{ old('no_telp', $crew->no_telp ?? '') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <select name="jabatan" class="form-control" required>
                                        <option value="">-- Pilih Jabatan --</option>
                                        <option value="HRD"
                                            {{ old('jabatan', $crew->jabatan ?? '') == 'HRD' ? 'selected' : '' }}>HRD
                                        </option>
                                        <option value="Crew"
                                            {{ old('jabatan', $crew->jabatan ?? '') == 'Crew' ? 'selected' : '' }}>Crew
                                        </option>
                                        <option value="Admin"
                                            {{ old('jabatan', $crew->jabatan ?? '') == 'Admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="Finance"
                                            {{ old('jabatan', $crew->jabatan ?? '') == 'Finance' ? 'selected' : '' }}>
                                            Finance</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control"
                                        value="{{ old('tanggal_lahir', $crew->tanggal_lahir ?? '') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Level</label>
                                    <select name="level" class="form-control" required>
                                        <option value="">-- Pilih Level --</option>
                                        <option value="junior"
                                            {{ old('level', $crew->level ?? '') == 'junior' ? 'selected' : '' }}>Junior
                                        </option>
                                        <option value="intermediate"
                                            {{ old('level', $crew->level ?? '') == 'intermediate' ? 'selected' : '' }}>
                                            Intermediate</option>
                                        <option value="senior"
                                            {{ old('level', $crew->level ?? '') == 'senior' ? 'selected' : '' }}>Senior
                                        </option>
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
