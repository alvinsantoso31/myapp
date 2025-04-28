@extends('layouts.app', [
    'activePage' => 'detail_events.index',
    'title' => 'Detail Events',
    'navName' => 'Detail Events',
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

            <a href="{{ url('event/form') }}" class="btn btn-primary mb-3">+ Tambah Event</a>

            <div class="row">
                @foreach ($events as $event)
                    @php
                        $badgeClass = match ($event->status) {
                            'pre-event' => 'badge-primary',
                            'ongoing' => 'badge-success',
                            'post-event' => 'badge-secondary',
                            default => 'badge-light',
                        };
                    @endphp
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm hoverable-card position-relative" style="transition: 0.3s;">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">{{ $event->nama_event }}</h5>
                                <form id="delete-form-{{ $event->id_event }}" action="{{ url('event/delete/' . $event->id_event) }}" method="POST" style="z-index:2;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger p-1 delete-button" onclick="confirmDelete({{ $event->id_event }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <a href="{{ url('detailEvents/detail/' . $event->id_event) }}" style="text-decoration: none; color: inherit; display:block;">
                                <div class="card-body text-center">
                                    <p class="mb-2" style="font-size: 14px">{{ $event->deskripsi_event }}</p>
                                    <span class="badge {{ $badgeClass }}">{{ $event->tipe_event }}</span>
                                </div>
                                <div class="card-footer text-center">
                                    @php
                                        $eventDate = \Carbon\Carbon::parse($event->tanggal_event);
                                        $daysLeft = now()->diffInDays($eventDate, false);
                                    @endphp
                                    <small class="text-muted">
                                        {{ $daysLeft > 0 ? 'Sisa waktu ' . $daysLeft . ' hari hingga acara.' : ($daysLeft == 0 ? 'Acara berlangsung hari ini!' : 'Acara sudah lewat.') }}
                                    </small>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <style>
        .hoverable-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
        }

        .delete-button:hover {
            background-color: #dc3545;
            color: white;
        }

        .delete-button i {
            pointer-events: none;
        }
    </style>

    <script>
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