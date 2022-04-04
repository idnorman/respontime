@extends('layouts.app')

@section('title', 'Kategori Penyakit')

@section('content')
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target="#tambahKategori">
                        + Tambah
                        Kategori
                    </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="kategori" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kategori as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        <div class="d-flex">

                                            <button type="button" class="btn btn-warning btn-sm mr-2" data-toggle="modal"
                                                data-target="#editKategori-{{ $item->id }}">
                                                <i class="fas fa-pencil-alt mr-2"></i> Edit
                                            </button>
                                            <form action="{{ route('penyakit.kategori.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash mr-2"></i> Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Update -->
                                <div class="modal fade" id="editKategori-{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editKategoriLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editKategoriLabel">Edit Kategori</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('penyakit.kategori.update', $item->id) }}"
                                                method="POST">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-group">
                                                        <label for="nama">Nama Kategori</label>
                                                        <input type="text" class="form-control" id="nama" name="nama"
                                                            value="{{ old('nama') ?? $item->nama }}" required>
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
                                    <td colspan="2" class="text-center">Data tidak ditemukan</td>
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
    <div class="modal fade" id="tambahKategori" tabindex="-1" aria-labelledby="tambahKategoriLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKategoriLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('penyakit.kategori.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf

                        <div class="form-group">
                            <label for="nama">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama" name="nama">
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
            $('#kategori').DataTable();
        });
    </script>
@endpush
