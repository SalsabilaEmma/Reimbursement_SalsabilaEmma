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
              <h5 class="">Form Karyawan</h5>
              {{-- <span>Data Client</span> --}}
            </div>
            <div class="card-body">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button class="btn-close" type="button" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                @if(isset($karyawan))
                    <form action="{{ route('karyawan.update', ['id' => $karyawan->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                @else
                    <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
                @endif
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                          <div class="mb-2">
                            <label>NIP</label>
                            <input class="form-control numeric-input" required name="nip" id="" type="text" maxlength="25" value="{{ isset($karyawan) ? $karyawan->nip : '' }}">
                          </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                          <div class="mb-2">
                            <label>Nama Karyawan</label>
                            <input class="form-control" name="nama" required id="" type="text" value="{{ isset($karyawan) ? $karyawan->nama : '' }}">
                          </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                          <div class="mb-2">
                            <label>Jabatan</label>
                            <select class="form-control" name="jabatan_select" required id="" >
                                <option selected hidden value="" disabled="disabled"> -Pilih Jabatan- </option>
                                <option value="DIREKTUR" {{ isset($karyawan) && $karyawan->jabatan === 'DIREKTUR' ? 'selected' : '' }}>DIREKTUR</option>
                                <option value="FINANCE" {{ isset($karyawan) && $karyawan->jabatan === 'FINANCE' ? 'selected' : '' }}>FINANCE</option>
                                <option value="STAFF" {{ isset($karyawan) && $karyawan->jabatan === 'STAFF' ? 'selected' : '' }}>STAFF</option>
                            </select>
                            <input type="hidden" name="jabatan" id="jabatan" value="{{ isset($pengajuan) ? $pengajuan->jabatan : '' }}">
                            {{-- <input class="form-control" name="jabatan" required id="" type="text" value="{{ isset($karyawan) ? $karyawan->jabatan : '' }}"> --}}
                          </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                          <div class="mb-2">
                            <label class="col-form-label">Email</label>
                            <input class="form-control" type="email" required name="email" name="email" value={{ isset($karyawan) ? $karyawan->email : '' }}>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                          <div class="mb-2">
                            <label>Password</label>
                            <input class="form-control" name="password" required id="" type="text" value="{{ isset($karyawan) ? '' : '' }}">
                          </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                          <div class="mb-2">
                            <label>Confirm Password</label>
                            <input class="form-control" name="password_confirmation" required id="" type="text" value="{{ isset($karyawan) ? '' : '' }}">
                          </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                      <button class="btn btn-primary" type="submit">{{ isset($karyawan) ? 'Perbarui' : 'Simpan' }}</button>
                      <a href="{{ route('karyawan') }}" class="btn btn-light">Kembali</a>
                    </div>
                </form>
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

@endsection
<!-- --------------------------------------------------------------------------------------------------------------------< javascript > -->
@section('js')

@endsection
