@extends('layouts.app')

@section('title', 'Pemeriksaan')

@section('content')
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target="#tambahPemeriksaan">
                        + Tambah Pemeriksaan
                    </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="penyakit" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Pasien</th>
                                <th>Penyakit</th>
                                <th>Status</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pemeriksaan as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td>{{ $item->pasien->nama }}</td>
                                    <td>{{ $item->penyakit->nama }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->created_at->format('h:i:s') }}</td>
                                    <td>{{ !is_null($item->waktu_selesai) ? date('h:i:s', strtotime($item->waktu_selesai)) : '' }}</td>
                                    <td>
                                        <div class="d-flex">
                                            @if (!$item->waktu_selesai)
                                            <form action="{{ route('pemeriksaan.update', $item->id) }}" method="POST" class="mr-1">
                                                @csrf
                                                @method('put')

                                                <button type="submit" class="btn btn-sm btn-success btn-done"><i class="far fa-check-circle mr-2"></i> Selesai</button>
                                            </form>
                                            @endif

                                            <form action="{{ route('pemeriksaan.destroy', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash mr-2"></i> Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="tambahPemeriksaan" tabindex="-1" aria-labelledby="tambahPemeriksaanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPemeriksaanLabel">Tambah Pemeriksaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pemeriksaan.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pasien">Nama Pasien</label>
                                    <input type="text" class="form-control" id="pasien" name="pasien">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="penyakit">Penyakit</label>
                            <select class="form-control" id="penyakit" name="penyakit" required>
                                <option>--- Pilih Penyakit ---</option>
                              @foreach ($penyakits as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('script')
    <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {
            $('#penyakit').DataTable();
        });

        $(document).ready(function(){
            @if(session()->has('reload'))
                localStorage.setItem('reload', 'true');
            @endif
        });

        $('.btn-done').on('click', function(){
            localStorage.setItem('reload', 'true');
        });
    </script>
@endpush
