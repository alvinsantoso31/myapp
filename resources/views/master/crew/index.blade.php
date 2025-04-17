@extends('layouts.app', [
    'activePage' => 'crew.index',
    'title' => 'Form Crew',
    'navName' => 'Crew Management',
    'activeButton' => 'laravel',
])

@section('content')
    
    <div class="content">
        <div class="container-fluid">
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

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <a href="{{ url('crew/form') }}" class="btn btn-primary mb-3">+ Tambah Crew</a>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Crew</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="crewTable">
                        <thead class="text-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No Telp</th>
                                <th>Jabatan</th>
                                <th>Tanggal Lahir</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($crew as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_lengkap }}</td>
                                    <td>{{ $item->no_telp }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td>{{ $item->tanggal_lahir }}</td>
                                    <td>{{ ucfirst($item->level) }}</td>
                                    <td>

                                        <a href="{{ url('crew/form/' . $item->id_crew) }}" class="btn btn-sm btn-warning"
                                            style="margin-right: 5px">Edit</a>

                                        <form id="delete-form-{{ $item->id_crew }}"
                                            action="{{ url('crew/delete/' . $item->id_crew) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <button class="btn btn-sm btn-danger"
                                            onclick="confirmDelete({{ $item->id_crew }})">Hapus</button>
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
        $('#crewTable').DataTable();

        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
