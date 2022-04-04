@extends('layouts.app')

@section('title', 'Daftar Penyakit')

@section('content')
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target="#tambahPenyakit">
                        + Tambah Daftar Penyakit
                    </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="penyakit" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Nama</th>
                                <th>Lama Proses</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penyakit as $item)
                                <tr>
                                    <td>{{ $item->kategori->nama }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ !is_null($item->waktu_minimal) ? 'Lebih dari ' . ($item->waktu_minimal/60) . ' jam' : 'Kurang dari ' . ($item->waktu_maksimal/60) . ' jam' }}</td>
                                    <td>
                                        <div class="d-flex">

                                            <button type="button" class="btn btn-warning btn-sm mr-2" data-toggle="modal"
                                                data-target="#editPenyakit-{{ $item->id }}">
                                                <i class="fas fa-pencil-alt mr-2"></i> Edit
                                            </button>
                                            <form action="{{ route('penyakit.daftar-penyakit.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash mr-2"></i> Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Update -->
                                <div class="modal fade" id="editPenyakit-{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editPenyakitLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editPenyakitLabel">Edit Kategori</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('penyakit.daftar-penyakit.update', $item->id) }}"
                                                method="POST">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-group">
                                                        <label for="kategori">Kategori</label>
                                                        <select class="form-control" id="kategori" name="kategori_id" required>
                                                            <option>--- Pilih Kategori ---</option>
                                                          @foreach ($kategori as $kat)
                                                            <option value="{{ $kat->id }}" {{ $kat->id == $item->kategori_id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                                                          @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="nama">Nama Penyakit</label>
                                                        <input type="text" class="form-control" id="nama" name="nama"
                                                            value="{{ old('nama') ?? $item->nama }}" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="waktu_minimal">Waktu Minimal</label>
                                                        <div class="row align-items-center">
                                                            <div class="col-6">
                                                                <input type="number" class="form-control mr-1" id="waktu_minimal" name="waktu_minimal" value="{{ old('waktu_minimal') ?? $item->waktu_minimal }}">
                                                            </div>
                                                            <div class="col">
                                                                <span>menit</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="waktu_maksimal">Waktu Maksimal</label>
                                                        <div class="row align-items-center">
                                                            <div class="col-6">
                                                                <input type="number" class="form-control mr-1" id="waktu_maksimal" name="waktu_maksimal" value="{{ old('waktu_maksimal') ?? $item->waktu_maksimal }}">
                                                            </div>
                                                            <div class="col">
                                                                <span>menit</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Data tidak ditemukan</td>
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
    <div class="modal fade" id="tambahPenyakit" tabindex="-1" aria-labelledby="tambahPenyakitLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPenyakitLabel">Tambah Daftar Penyakit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('penyakit.daftar-penyakit.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf

                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" id="kategori" name="kategori_id" required>
                                <option>--- Pilih Kategori ---</option>
                              @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                              @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Penyakit</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>

                        <div class="form-group">
                            <label for="waktu_minimal">Waktu Minimal</label>
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <input type="number" class="form-control mr-1" id="waktu_minimal" name="waktu_minimal">
                                </div>
                                <div class="col">
                                    <span>menit</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="waktu_maksimal">Waktu Maksimal</label>
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <input type="number" class="form-control mr-1" id="waktu_maksimal" name="waktu_maksimal">
                                </div>
                                <div class="col">
                                    <span>menit</span>
                                </div>
                            </div>
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
    </script>
@endpush
