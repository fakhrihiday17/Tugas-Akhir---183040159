<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//panggil model Admin
use App\Models\AdminModel;

class AdminController extends Controller
{
    //method untuk tampil data admin
    public function admintampil()
    {
        $dataadmin = AdminModel::orderby('id_admin', 'ASC')
            ->paginate(5);

        return view('halaman/view_admin', ['admin' => $dataadmin]);
    }

    //method untuk tambah data admin
    public function admintambah(Request $request)
    {
        $this->validate($request, [
            'nama_admin' => 'required',
            'email_admin' => 'required'
        ]);

        AdminModel::create([
            'nama_admin' => $request->nama_admin,
            'email_admin' => $request->email_admin
        ]);

        return redirect('/admin');
    }

    //method untuk hapus data admin
    public function adminhapus($id_admin)
    {
        $dataadmin = AdminModel::find($id_admin);
        $dataadmin->delete();

        return redirect()->back();
    }

    //method untuk edit data admin
    public function adminedit($id_admin, Request $request)
    {
        $this->validate($request, [
            'nama_admin' => 'required',
            'email_admin' => 'required'
        ]);

        $id_admin = AdminModel::find($id_admin);
        $id_admin->nama_admin      = $request->nama_admin;
        $id_admin->email_admin   = $request->email_admin;

        $id_admin->save();

        return redirect()->back();
    }
}
