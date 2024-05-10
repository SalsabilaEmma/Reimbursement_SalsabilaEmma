@extends('layout.app')
@section('content')

<div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5 class="">Pengajuan Reimbursement</h5>
              {{-- <span>Data Client</span> --}}
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success, </strong> {{ $message }}
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                            data-bs-original-title="" title=""></button>
                    </div>
                @elseif ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button class="btn-close" type="button" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                @if (Auth::user()->jabatan === "STAFF")
                    <a href="{{ route('pengajuan.form') }}" class="btn btn-primary mb-3">Tambah Data</a>
                @endif
                <div class="dt-ext table-responsive">
                  <table class="display" id="show-hidden-row">
                    <thead>
                      <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Karyawan</th>
                        <th>Deskripsi</th>
                        <th>File</th>
                        <th>Status Direktur</th>
                        <th>Status Reimbursement</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuan as $no => $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->tgl }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td class="text-center">
                                    @if($item->file)
                                        @if ($item->fileType == 'image')
                                            <img src="{{ asset('file/' . $item->file ) }}" style="max-width: 100px; max-height: 100px;" alt="File">
                                        @else
                                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal-{{ $loop->iteration }}">
                                                Buka File
                                            </button>

                                            <div class="modal fade" id="exampleModal-{{ $loop->iteration }}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">File Pengajuan</h5>
                                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <embed src="{{ asset('file/' . $item->file ) }}" type="application/pdf" style="width: 100%; height: 500px;">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        Tidak Ada File
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->status === "1")
                                        <span class="badge badge-success">Disetujui</span>
                                    @elseif ($item->status === "2")
                                        <span class="badge badge-danger">Ditolak</span>
                                    @else
                                        <span class="badge badge-secondary">Belum<br>Disetujui</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->statusReimburse === "1")
                                        <span class="badge badge-success">Sudah<br>Dicairkan</span>
                                    @elseif ($item->statusReimburse === "2")
                                        <span class="badge badge-danger">Ditolak</span>
                                    @else
                                        <span class="badge badge-secondary">Proses</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('pengajuan.form', $item->id) }}">
                                        <button title="Edit" type="button" class="btn btn-xs btn-warning mb-2">Edit
                                            <i class="icon-pencil-alt"></i>
                                        </button>
                                    </a>
                                    @if (Auth::user()->jabatan === "STAFF")
                                        <form action="{{ route('pengajuan.delete', $item->id) }}" onsubmit="return confirm('Apakah Anda Yakin ?');" method="POST">
                                            @csrf
                                            <button title="Hapus" class="btn btn-xs btn-danger" type="submit">Delete
                                                <i class="icon-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->


</div>

@endsection

<!-- --------------------------------------------------------------------------------------------------------------------< css > -->
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/datatables.css">
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/datatable-extension.css">
@endsection
<!-- --------------------------------------------------------------------------------------------------------------------< javascript > -->
@section('js')
    <script src="{{ url('cuba') }}/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('cuba') }}/assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('cuba') }}/assets/js/datatable/datatable-extension/dataTables.responsive.min.js"></script>
    <script src="{{ url('cuba') }}/assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js"></script>
    <script src="{{ url('cuba') }}/assets/js/datatable/datatable-extension/custom.js"></script>

@endsection
