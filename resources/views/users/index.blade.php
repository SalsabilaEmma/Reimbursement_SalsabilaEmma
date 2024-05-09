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
              <h5 class="">Karyawan</h5>
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
                <a href="{{ route('karyawan.form') }}" class="btn btn-primary mb-3">Tambah Data</a>
                <div class="dt-ext table-responsive">
                  <table class="display" id="show-hidden-row">
                    <thead>
                      <tr class="text-center">
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama Karyawan</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        {{-- <th>Password</th> --}}
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawan as $no => $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->nip }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->email }}</td>
                                {{-- <td>{{ $item->password }}</td> --}}
                                <td class="text-center">
                                    <a href="{{ route('karyawan.form', $item->id) }}">
                                        <button title="Edit" type="button" class="btn btn-xs btn-warning mb-2">
                                            <i class="icon-pencil-alt"></i>
                                        </button>
                                    </a>
                                    <form action="{{ route('karyawan.delete', $item->id) }}" onsubmit="return confirm('Apakah Anda Yakin ?');" method="POST">
                                        @csrf
                                        <button title="Hapus" class="btn btn-xs btn-danger" type="submit">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </form>
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
