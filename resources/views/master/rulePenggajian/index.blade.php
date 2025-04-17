@extends('layouts.app', [
    'activePage' => 'rule_penggajian.index',
    'title' => 'Rule Penggajian',
    'navName' => 'Rule Gaji',
    'activeButton' => 'finance',
])

@section('content')
    <div class="content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <a href="{{ url('rulePenggajian/form') }}" class="btn btn-primary mb-3">+ Tambah Rule</a>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Rule Penggajian</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="ruleTable">
                        <thead class="text-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Rule</th>
                                <th>Level</th>
                                <th>Jobdesk</th>
                                <th>Lokasi</th>
                                <th>Tipe</th>
                                <th>Addon</th>
                                <th>Gaji Minimal</th>
                                <th>Gaji Perjam</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rules as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_rule }}</td>
                                    <td>{{ ucfirst($item->level) }}</td>
                                    <td>{{ $item->nama_jobdesk }}</td>
                                    <td>{{ $item->lokasi }}</td>
                                    <td>{{ ucfirst($item->tipe_event) }}</td>
                                    <td>{{ $item->isAddons ? 'Ya' : 'Tidak' }}</td>
                                    <td>Rp{{ number_format($item->gaji_minimal, 0, ',', '.') }}</td>
                                    <td>Rp{{ number_format($item->gaji_perjam, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ url('rulePenggajian/form/' . $item->id_rule_penggajian) }}"
                                            class="btn btn-sm btn-warning" style="margin-right: 5px">Edit</a>
                                        <form id="delete-form-{{ $item->id_rule_penggajian }}"
                                            action="{{ url('rulePenggajian/delete/' . $item->id_rule_penggajian) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button class="btn btn-sm btn-danger"
                                            onclick="confirmDelete({{ $item->id_rule_penggajian }})">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <script>
        $('#ruleTable').DataTable();

        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus rule ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
