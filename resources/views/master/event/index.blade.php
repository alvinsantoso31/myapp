@extends('layouts.app', [
    'activePage' => 'event.index',
    'title' => 'Data Event',
    'navName' => 'Event Management',
    'activeButton' => 'laravel',
])

@section('content')
<div class="content">
    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert" style="padding-right: 3rem;">
                <div>
                    <strong>Sukses!</strong> {{ session('success') }}
                </div>
                <button type="button" class="close ml-3" data-dismiss="alert" aria-label="Close" style="position: absolute; right: 1rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">History Event</h4>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="eventTable">
                    <thead class="text-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Event</th>
                            <th>Tanggal Closing</th>
                            <th>Lokasi</th>
                            <th>Briefing</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama_event }}</td>
                                <td>{{ Illuminate\Support\Str::limit($item->deskripsi_event, 40) }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_event)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_closing)->format('d M Y') }}</td>
                                <td>{{ $item->lokasi_event }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->jadwal_briefing)->format('d M Y H:i') }}</td>
                                <td>{{ ucfirst($item->tipe_event) }}</td>
                                <td>{{ $item->status }}</td>
                                <td><a href="{{ URL('detailEvents/detail/'.$item->id_event) }}" class="btn btn-primary">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#eventTable').DataTable();

    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus event ini?',
            text: "Tindakan ini tidak dapat dibatalkan.",
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