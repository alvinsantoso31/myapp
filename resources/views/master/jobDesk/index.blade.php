@extends('layouts.app', [
    'activePage' => 'D.index',
    'title' => 'Job Desk',
    'navName' => 'Master Jobdesk',
    'activeButton' => 'laravel',
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

            <a href="{{ url('jobdesk/form') }}" class="btn btn-primary mb-3">+ Tambah Jobdesk</a>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Jobdesk</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="jobdeskTable">
                        <thead class="text-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Jobdesk</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobdesks as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_jobdesk }}</td>
                                    <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                                    <td>
                                        <a href="{{ url('jobdesk/form/' . $item->id_jobdesk) }}"
                                            class="btn btn-sm btn-warning" style="margin-right: 5px">Edit</a>
                                        <form id="delete-form-{{ $item->id_jobdesk }}"
                                            action="{{ url('jobdesk/delete/' . $item->id_jobdesk) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button class="btn btn-sm btn-danger"
                                            onclick="confirmDelete({{ $item->id_jobdesk }})">Hapus</button>
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
        $('#jobdeskTable').DataTable();

        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus jobdesk ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
