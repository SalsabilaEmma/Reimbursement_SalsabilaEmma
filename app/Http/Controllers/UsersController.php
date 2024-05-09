<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $karyawan = User::latest()->get();
            return view('users.index', compact('karyawan'));
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
            if ($id) {
                $karyawan = User::findOrFail($id);
                return view('users.form', compact('karyawan'));
            } else {
                return view('users.form');
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
            $validator = validator::make(
                $request->all(),
                [
                    'nip' => ['required', 'numeric', 'unique:' . User::class],
                    'nama' => ['required', 'string'],
                    'email' => ['required',  'email', 'unique:' . User::class],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ],
                [
                    'nip.numeric' => 'NIP Harus Berupa Angka',
                    'nip.unique' => 'Email Sudah Terdaftar',
                    'email.email' => 'Email Harus Berformat test@gmail.com',
                    'email.unique' => 'Email Sudah Terdaftar',
                ]
            );
            if ($validator->fails()) {
                return redirect(route('karyawan.form'))->with('error', $validator->errors());
            }

            $karyawan = new User;
            $karyawan->nip = $request->nip;
            $karyawan->nama = $request->nama;
            $karyawan->jabatan = $request->jabatan_select;
            $karyawan->email = $request->email;
            $karyawan->password = Hash::make($request->password);
            // dd($karyawan);
            $karyawan->save();

            event(new Registered($karyawan));
            return redirect(route('karyawan'))->with('success', 'Data Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            Log::error("update remburse : " . $e->getMessage());
            return redirect()->route('pengajuan')->with('error', "Telah terjadi kesalahan");
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
                    'nip' => ['required', 'numeric', 'unique:' . User::class],
                    'nama' => ['required', 'string'],
                    'email' => ['required',  'email', 'unique:' . User::class],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ],
                [
                    'nip.numeric' => 'NIP Harus Berupa Angka',
                    'nip.unique' => 'Email Sudah Terdaftar',
                    'email.email' => 'Email Harus Berformat test@gmail.com',
                    'email.unique' => 'Email Sudah Terdaftar',
                ]
            );
            if ($validator->fails()) {
                return redirect(route('karyawan.form', $id))->with('error', $validator->errors());
            }

            $karyawan = User::findOrFail($id);

            $karyawan->update([
                'nip' => $request->input('nip'),
                'nama' => $request->input('nama'),
                'jabatan' => $request->input('jabatan_select'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->password),
            ]);
            return redirect(route('karyawan'))->with('success', 'Data berhasil diperbarui!');
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
            User::destroy($id);
            return redirect()->route('karyawan')->with('success', 'Data Berhasil Dihapus!');
        } catch (\Exception $e) {
            Log::error("update remburse : " . $e->getMessage());
            return redirect()->route('pengajuan')->with('error', "Telah terjadi kesalahan");
        }
    }
}
