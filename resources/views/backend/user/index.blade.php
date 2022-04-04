@extends('layouts.app')

@section('title', 'Daftar Pengguna')

@section('content')
    <div class="row">
        <div class="col">

            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="penyakit" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>email</th>
                                <th>Posisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($user as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->getRoleNames()[0] }}</td>
                                    <td>
                                        @if (Auth::user()->name !== $item->name)
                                        <div class="d-flex">
                                                @if ($item->getRoleNames()[0] !== 'Admin')
                                                <form action="{{ route('user.update', $item->id) }}" method="POST" class="mr-1">
                                                    @csrf
                                                    @method('put')

                                                    <button type="submit" class="btn btn-sm btn-success">Jadikan Admin</button>
                                                </form>
                                                {{-- @else
                                                <form action="{{ route('user.petugas', $item->id) }}" method="POST" class="mr-1">
                                                    @csrf
                                                    @method('put')

                                                    <button type="submit" class="btn btn-sm btn-info">Jadikan Petugas Lab</button>
                                                </form> --}}
                                                @endif

                                            <form action="{{ route('user.destroy', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash mr-2"></i> Hapus</button>
                                            </form>
                                        </div>
                                        @endif
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
