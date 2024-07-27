<?php

namespace App\Http\Controllers;

use App\Models\AdminAcc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAccController extends Controller
{
    public function admin()
    {
        $admins = AdminAcc::all();

        $title = 'Registrasi Admin';
        $role = 'admin';

        return view('admin.registrasi_admin', compact('admins', 'title', 'role'));
    }

    public function create()
    {
        $maxIdAdmin = AdminAcc::max('id_admin') ?? 0;
        $idAdmin = $maxIdAdmin + 1;

        $title = 'Tambah Akun Admin';
        $role = 'admin';

        return view('admin.registrasi_admin_tambah', compact('idAdmin', 'title', 'role'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_admin' => 'required|integer',
            'nama_admin' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string',
            'level' => 'required|string|in:Admin'
        ]);

        // Simpan data ke database
        AdminAcc::create([
            'id_admin' => $request->id_admin,
            'nama_admin' => $request->nama_admin,
            'username' => $request->username,
            'password' => $request->password,
            'level' => $request->level
        ]);

        // Redirect ke halaman daftar admin dengan pesan sukses
        return redirect()->route('admin.registrasi-admin')->with('insert_success', 'Data admin berhasil ditambahkan.');
    }

    public function edit($id) 
    {
        $dataAdmin = AdminAcc::findOrFail($id);

        $title = 'Edit Akun Admin';
        $role = 'admin';

        return view('admin.registrasi_admin_edit', compact('dataAdmin', 'title', 'role'));
    }

    public function update(Request $request, $id)
    {
        $dataAdmin = AdminAcc::findOrFail($id);

        $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string',
        ]);

        if (empty($request->password)) {
            $dataAdmin->update([
                'nama_admin' => $request->nama_admin,
                'username' => $request->username,
            ]);
        } else {
            $dataAdmin->update([
                'nama_admin' => $request->nama_admin,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
        }

        // Redirect ke halaman daftar admin dengan pesan sukses
        return redirect()->route('admin.registrasi-admin')->with('update_success', 'Data admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cari siswa berdasarkan ID
        $admin = AdminAcc::find($id);

        // Jika admin ditemukan, hapus
        if ($admin) {
            $admin->delete();
            return redirect()->route('admin.registrasi-admin')->with('delete_success', 'Data admin berhasil dihapus.');
        }

        // Jika admin tidak ditemukan, kembalikan dengan pesan error
        return redirect()->route('admin.registrasi-admin')->with('delete_error', 'Data admin tidak ditemukan.');
    }
}
