<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (Auth::user()->jabatan == "STAFF") {
                $nama = Auth::user()->nama;
                $pengajuan = Pengajuan::where('nama', $nama)->latest()->get();
            } else if (Auth::user()->jabatan == "FINANCE") {
                $pengajuan = Pengajuan::where('status', "1")->latest()->get();
            } else {
                $pengajuan = Pengajuan::latest()->get();
            }
            // dd($pengajuan);
            return view('pengajuan.index', compact('pengajuan'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('pengajuan')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function form($id = null)
    {
        try {
            $timezone = Carbon::now();
            $timezone->timezone = 'Asia/Jakarta';
            $time = $timezone->toTimeString();
            if ($id) {
                $pengajuan = Pengajuan::findOrFail($id);
                return view('pengajuan.form', compact('pengajuan'));
            } else {
                return view('pengajuan.form', compact('timezone', 'time'));
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('pengajuan')->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $validator = Validator::make(
                $request->all(),
                [
                    'tgl' => ['required', 'date'],
                    'file' => ['required', 'file', 'mimetypes:image/jpeg,image/png,image/jpg,application/pdf'],
                    'deskripsi' => ['required'],
                ],
                [
                    'file.mimetypes' => 'File Harus Berformat .jpeg, .jpg, .png atau pdf',
                ]
            );
            if ($validator->fails()) {
                return redirect(route('pengajuan.form'))->with('error', $validator->errors());
            }

            $pengajuan = new Pengajuan;
            $pengajuan->tgl = $request->tgl;
            $pengajuan->nama = $request->nama_select;
            $pengajuan->deskripsi = $request->deskripsi;

            // // Konversi file menjadi base64
            // $file = $request->file('file');
            // $base64File = base64_encode(File::get($file));
            // $pengajuan->file = $base64File;

            $file = $request->file('file');
            $mimeType = $file->getMimeType(); // Mendapatkan mime type file
            $base64File = base64_encode(File::get($file)); // Mengubah file menjadi base64
            $fileType = 'image'; // Default as image
            if (strpos($mimeType, 'image/') !== false) {
                $fileType = 'image';
            } else if (strpos($mimeType, 'application/pdf') !== false) {
                $fileType = 'pdf';
            }
            $pengajuan->fileType = $fileType; // Menyimpan jenis file
            $pengajuan->file = $base64File; // Menyimpan data base64 file

            // dd($pengajuan);
            $pengajuan->save();

            return redirect(route('pengajuan'))->with('success', 'Data Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('pengajuan')->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        try {
            $validator = validator::make(
                $request->all(),
                [
                    'tgl' => ['required']
                ]
            );
            if ($validator->fails()) {
                return redirect(route('pengajuan.form', $id))->with('error', $validator->errors());
            }

            $pengajuan = Pengajuan::findOrFail($id);

            $dataToUpdate = [
                'tgl' => $request->input('tgl'),
                'nama' => $request->input('nama_select'),
                'deskripsi' => $request->input('deskripsi'),
            ];
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $mimeType = $file->getMimeType();

                $base64File = base64_encode(File::get($file));
                $fileType = 'image';

                if (strpos($mimeType, 'image/') !== false) {
                    $fileType = 'image';
                } else {
                    $fileType = 'pdf';
                }

                $dataToUpdate['fileType'] = $fileType;
                $dataToUpdate['file'] = $base64File;
            }

            $dataToUpdateDirektur = [
                'status' => $request->input('status_select'),
            ];
            $dataToUpdateFinance = [
                'statusReimburse' => $request->input('statusReimburse_select'),
            ];
            if (Auth::user()->jabatan === 'DIREKTUR') {
                // dd('masuk direktur');
                $pengajuan->update($dataToUpdateDirektur);
            } else if (Auth::user()->jabatan === 'FINANCE') {
                // dd('masuk finance', $dataToUpdateFinance);
                $pengajuan->update($dataToUpdateFinance);
            } else {
                // dd('masuk staff');
                $pengajuan->update($dataToUpdate);
            }

            return redirect(route('pengajuan'))->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('pengajuan')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Pengajuan::destroy($id);
            return redirect()->route('pengajuan')->with('success', 'Data Berhasil Dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('pengajuan')->with('error', $e->getMessage());
        }
    }

    // --------------------------------------------------------------------------------------------------------< Direktur >

    // --------------------------------------------------------------------------------------------------------< Finance >
    public function indexFinance()
    {
        try {
            $nama = Auth::user()->nama;
            $pengajuan = Pengajuan::where('status', "1")->latest()->get();
            // dd($pengajuan);
            return view('pengajuan.index', compact('pengajuan'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('pengajuan')->with('error', $e->getMessage());
        }
    }
}
