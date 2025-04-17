@extends('layouts.app', [
    'activePage' => 'rule_penggajian.form',
    'title' => 'Form Rule Penggajian',
    'navName' => 'Rule Gaji',
    'activeButton' => 'finance',
])

@section('content')
<div class="content">
    <div class="container-fluid">
        <a href="{{ url('rulePenggajian') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar Rule</a>

        <div class="row justify-content-start">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ isset($rule) ? 'Edit Rule' : 'Tambah Rule' }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('rulePenggajian/update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id_rule_penggajian" value="{{ old('id_rule_penggajian', $rule->id_rule_penggajian ?? '') }}">

                            <div class="form-group">
                                <label>Nama Rule</label>
                                <input type="text" name="nama_rule" class="form-control" value="{{ old('nama_rule', $rule->nama_rule ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Level</label>
                                <select name="level" class="form-control" required>
                                    <option value="">-- Pilih Level --</option>
                                    <option value="junior" {{ old('level', $rule->level ?? '') == 'junior' ? 'selected' : '' }}>Junior</option>
                                    <option value="intermediate" {{ old('level', $rule->level ?? '') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                    <option value="senior" {{ old('level', $rule->level ?? '') == 'senior' ? 'selected' : '' }}>Senior</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Jobdesk</label>
                                <select name="id_jobdesk" class="form-control" required>
                                    <option value="">-- Pilih Jobdesk --</option>
                                    @foreach ($jobdesks as $jd)
                                        <option value="{{ $jd->id_jobdesk }}" {{ old('id_jobdesk', $rule->id_jobdesk ?? '') == $jd->id_jobdesk ? 'selected' : '' }}>
                                            {{ $jd->nama_jobdesk }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $rule->lokasi ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Tipe Event</label>
                                <select name="tipe_event" class="form-control" required>
                                    <option value="">-- Pilih Tipe Event --</option>
                                    <option value="Pernikahan" {{ old('tipe_event', $rule->tipe_event ?? '') == 'Pernikahan' ? 'selected' : '' }}>Pernikahan</option>
                                    <option value="Ulang Tahun" {{ old('tipe_event', $rule->tipe_event ?? '') == 'Ulang Tahun' ? 'selected' : '' }}>Ulang Tahun</option>
                                    <option value="Company" {{ old('tipe_event', $rule->tipe_event ?? '') == 'Company' ? 'selected' : '' }}>Company</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Addon</label>
                                <select name="isAddons" class="form-control" required>
                                    <option value="0" {{ old('isAddons', $rule->isAddons ?? '') == '0' ? 'selected' : '' }}>Tidak</option>
                                    <option value="1" {{ old('isAddons', $rule->isAddons ?? '') == '1' ? 'selected' : '' }}>Ya</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Gaji Minimal</label>
                                <input type="number" name="gaji_minimal" class="form-control" value="{{ old('gaji_minimal', $rule->gaji_minimal ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Gaji Perjam</label>
                                <input type="number" name="gaji_perjam" class="form-control" value="{{ old('gaji_perjam', $rule->gaji_perjam ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Timestamp</label>
                                <input type="datetime-local" name="timestamp" class="form-control"
                                    value="{{ old('timestamp', isset($rule) ? \Carbon\Carbon::parse($rule->timestamp)->format('Y-m-d\TH:i') : '') }}" required>
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
