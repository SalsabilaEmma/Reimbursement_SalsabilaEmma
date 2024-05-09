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
              <h5 class="">Form Pengajuan Reimbursement</h5>
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
                @if(isset($pengajuan))
                    <form action="{{ route('pengajuan.update', ['id' => $pengajuan->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                @else
                    <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                @endif
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                          <div class="mb-2">
                            <label>Tanggal</label>
                            <input type="date" class="form-control @error('tgl') is-invalid @enderror" id="tgl"
                                name="tgl" placeholder="YYYY-MM-DD" value="{{ isset($pengajuan) ? $pengajuan->tgl : $timezone }}"
                            required {{ Auth::user()->jabatan !== 'staff' && isset($pengajuan) ? 'readonly' : '' }}>
                          </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                          <div class="mb-2">
                            <label>Nama Karyawan</label>
                            <input readonly class="form-control" name="nama_select" required id="" type="text" value="{{ isset($pengajuan) ? $pengajuan->nama : Auth::user()->nama }}">
                          </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                          <div class="mb-2">
                            <label>File</label>
                            <div class="mb-2">
                                @if (isset($pengajuan))
                                    @if($pengajuan->file)
                                        @if ($pengajuan->fileType == 'image')
                                            <img src="data:image/jpeg;base64,{{ $pengajuan->file }}" style="max-width: 100px; max-height: 100px;" alt="File">
                                        @else
                                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal-{{ $pengajuan->id }}">
                                                Buka File Lama
                                            </button>
                                            <div class="modal fade" id="exampleModal-{{ $pengajuan->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">File Pengajuan</h5>
                                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <embed src="data:application/pdf;base64,{{ $pengajuan->file }}" type="application/pdf" style="width: 100%; height: 500px;">
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
                                @endif
                            </div>
                            @if (Auth::user()->jabatan === 'STAFF')
                                <input class="form-control" name="file" required id="file" type="file" value="{{ isset($pengajuan) ? $pengajuan->file : '' }}" accept=".jpg,.jpeg,.png,.pdf">
                            @endif
                          </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="mb-2">
                              <label class="col-form-label">Deskripsi</label>
                              <input class="form-control" type="deskripsi" rows="3" required name="deskripsi" name="deskripsi" value={{ isset($pengajuan) ? $pengajuan->deskripsi : '' }}  {{ Auth::user()->jabatan !== 'staff' && isset($pengajuan) ? 'readonly' : '' }}>
                            </div>
                        </div>
                        @if (Auth::user()->jabatan !== 'STAFF')
                            <div class="col-lg-6 col-sm-6">
                                <div class="mb-2">
                                    <label class="col-form-label">Status Direktur</label>
                                    <select class="form-control" name="status_select" required  {{ Auth::user()->jabatan !== 'DIREKTUR' && isset($pengajuan) ? 'disabled' : '' }}>
                                        <option value="0" {{ isset($pengajuan) && $pengajuan->status === "0" ? 'selected' : '' }}>Belum Disetujui</option>
                                        <option value="1" {{ isset($pengajuan) && $pengajuan->status === "1" ? 'selected' : '' }}>Disetujui</option>
                                        <option value="2" {{ isset($pengajuan) && $pengajuan->status === "2" ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <input type="hidden" name="status" id="status" value="{{ isset($pengajuan) ? $pengajuan->status : '0' }}">
                                </div>
                            </div>
                        @endif
                        @if (Auth::user()->jabatan === 'FINANCE')
                            <div class="col-lg-6 col-sm-6">
                                <div class="mb-2">
                                    <label class="col-form-label">Status Reimbursement</label>
                                    <select class="form-control" name="statusReimburse_select" required {{ Auth::user()->jabatan !== 'FINANCE' && isset($pengajuan) ? 'disabled' : '' }}>
                                        <option value="0" {{ isset($pengajuan) && $pengajuan->statusReimburse === "0" ? 'selected' : '' }}>Proses</option>
                                        <option value="1" {{ isset($pengajuan) && $pengajuan->statusReimburse === "1" ? 'selected' : '' }}>Sudah Dicairkan</option>
                                        <option value="2" {{ isset($pengajuan) && $pengajuan->statusReimburse === "2" ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <input type="hidden" name="status" id="status" value="{{ isset($pengajuan) ? $pengajuan->statusReimburse : '0' }}">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer text-end">
                      <button class="btn btn-primary" type="submit">{{ isset($pengajuan) ? 'Perbarui' : 'Simpan' }}</button>
                      <a href="{{ route('pengajuan') }}" class="btn btn-light">Kembali</a>
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
