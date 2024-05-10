<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
// use Intervention\Image\Image;
// use Image;
use Intervention\Image\ImageManagerStatic as Image;



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
            return view('pengajuan.index', compact('pengajuan'));
        } catch (\Exception $e) {
            Log::error("update remburse : " . $e->getMessage());
            return redirect()->route('pengajuan')->with('error', "Telah terjadi kesalahan");
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
            Log::error("update remburse : " . $e->getMessage());
            return redirect()->route('pengajuan')->with('error', "Telah terjadi kesalahan");
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
                    'tgl' => ['date'],
                    'file' => ['file', 'mimetypes:image/jpeg,image/png,image/jpg,application/pdf'],
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

            if ($request->hasFile('file')) {
                $file = $request->file('file');

                if ($file->getClientOriginalExtension() == 'pdf') {
                    // If it's a PDF file, move it to the file directory
                    // $namafile = time() . '.' . $file->getClientOriginalExtension();
                    // $file->move('file/' . $namafile);
                    $namafile = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('file'), $namafile);
                    $pengajuan->file = $namafile;
                    $pengajuan->fileType = 'pdf';
                } elseif (in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                    // If it's an image file, resize and save it
                    if (!File::isDirectory('file/' . $request->id)) {
                        File::makeDirectory('file/' . $request->id);
                    }
                    $namafile = time() . '.' . $file->getClientOriginalExtension();
                    Image::make($file)->resize(300, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save('file/' . $namafile);
                    // Save the original image file
                    $file->move('file-original/' . $namafile);
                    $pengajuan->file = $namafile;
                    $pengajuan->fileType = 'image';
                } else {
                    // Handle other file types here if needed
                }
            }

            // dd($pengajuan);
            $pengajuan->save();

            return redirect(route('pengajuan'))->with('success', 'Data Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            dd($e);
            Log::error("update remburse : " . $e->getMessage());
            return redirect()->route('pengajuan.form')->with('error', "Telah terjadi kesalahan");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
                $filePath = public_path('file/' . $pengajuan->file);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

                $file = $request->file('file');
                if ($file->getClientOriginalExtension() == 'pdf') {
                    $namafile = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('file'), $namafile);
                    $pengajuan->file = $namafile;
                    $pengajuan->fileType = 'pdf';
                } else {
                    // If it's an image file, resize and save it
                    if (!File::isDirectory('file/' . $request->id)) {
                        File::makeDirectory('file/' . $request->id);
                    }
                    $namafile = time() . '.' . $file->getClientOriginalExtension();
                    Image::make($file)->resize(300, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save('file/' . $namafile);
                    $file->move('file-original/' . $namafile);
                    $pengajuan->file = $namafile;
                    $pengajuan->fileType = 'image';
                }
            }

            $dataToUpdateDirektur = [
                'status' => $request->input('status_select'),
            ];
            $dataToUpdateFinance = [
                'statusReimburse' => $request->input('statusReimburse_select'),
            ];
            if (Auth::user()->jabatan === 'DIREKTUR') {
                $pengajuan->update($dataToUpdateDirektur);
            } else if (Auth::user()->jabatan === 'FINANCE') {
                $pengajuan->update($dataToUpdateFinance);
            } else {
                $pengajuan->update($dataToUpdate);
            }

            return redirect(route('pengajuan'))->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error("update remburse : " . $e->getMessage());
            return redirect()->route('pengajuan')->with('error', "Telah terjadi kesalahan");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Pengajuan::destroy($id);
            $pengajuan = Pengajuan::findOrFail($id);
            if ($pengajuan->file) {
                $filePath = public_path('file/' . $pengajuan->file);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
            $pengajuan->delete();
            return redirect()->route('pengajuan')->with('success', 'Data Berhasil Dihapus!');
        } catch (\Exception $e) {
            Log::error("update remburse : " . $e->getMessage());
            return redirect()->route('pengajuan')->with('error', "Telah terjadi kesalahan");
        }
    }
}
