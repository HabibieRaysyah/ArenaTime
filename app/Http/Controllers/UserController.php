<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereIn('role', ['staff'])->get();
        return view('admin.staff.index', compact('users'));
    }

    public function profile(){
        $activityLogs = Activity::where('causer_id', Auth::user()->id)->with('causer')->latest()->limit(5)->get();
        return view('profile.profile_section',compact('activityLogs'));
    }

    public function updateprofile(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'email' => 'required',
            'number' => 'required',
            'address' => 'required',
        ],[
            'name.required' => 'Nama wajib diisi!!',
            'age.required' => 'Umur harus diisi!!',
            'email.required' => 'Email wajib diisi!!',
            'number.required' => 'Number wajib diisi!!',
            'address.required' => 'Address wajib diisi'
        ]);

        $updateData = User::find($id);
        $updateData->update([
            'name' => $request->name,
            'number_phone' => $request->number,
            'age' => $request->age,
            'address' => $request->address
        ]);

        activity()
        ->causedBy(Auth::user())
        ->performedOn($updateData)
        ->log('Berhasil Mengupdate Data');

        if ($updateData){
            return redirect()->back()->with('success','Berhasil mengupdate Data!!');
        }else{
            return redirect()->back()->with('failed','Gagal mengupdate Data!!');

        }
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email:dns',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Nama harus diisi!',
            'name.min' => 'Nama minimal 5 karakter',
            'email.required' => 'Email harus di isi',
            'password.required' => 'Password harus di isi',
            'password.min' => 'Password harus minimal 8 karakter',
        ]);

        $createData = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        if ($createData) {
            return redirect()->back()->with('success', 'Berhasil membuat akun silahkan login!!');
        } else {
            return redirect()->back()->with('failed', 'Gagal membuat akun!!');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email harus di isi',
            'password.required' => 'Password harus di isi',
            'password.min' => 'Password harus minimal 8 karakter',
        ]);
        $data = $request->only(['email', 'password']);

        if (Auth::attempt($data)) {
            // redirect() : memindahakn halaman, route () : memanggil name route, with (): mengirimkan session data biasanya untuk notifikasi
            // kalau admin ke dashboard, selain itu home
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('Success', 'Berhasil Berhasil login');
            } elseif (Auth::user()->role == 'staff') {
                return redirect()->route('staff.dashboard')->with('login', 'Berhasil Login');
            } else {
                return redirect()->route('home')->with('Success', 'Berhasil Berhasil login');
            }
        } else {
            // back () : kembali ke halaman sebelumnya
            return redirect()->back()->with('error', 'Gagal login! Sialah coba lagi');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Berhasil Logout');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email:dns',
            'role' => 'required|in:staff,user',
            'password' => 'required|min:8'
        ], [
            'name.required' => 'Nama harus diisi!',
            'name.min' => 'Nama minimal 5 karakter',
            'email.required' => 'Email harus diisi!',
            'email.emai' => 'Email harus yang valid',
            'role.required' => 'Role harus diisi!',
            'role.in' => 'Role harus berisi staff / user',
            'password.required' => 'Password harus diisi!',
            'password.min' => 'Password harus nya 8 karakter!',
        ]);

        $createData = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);

        if ($createData) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data!!');
        } else {
            return redirect()->back()->with('failed', 'Gagal menambahkan data!!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.staff.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email:dns',
            'role' => 'required|in:staff,user',
            'password' => 'nullable'
        ], [
            'name.required' => 'Nama harus diisi!',
            'name.min' => 'Nama minimal 5 karakter',
            'email.required' => 'Email harus diisi!',
            'email.emai' => 'Email harus yang valid',
            'role.required' => 'Role harus diisi!',
            'role.in' => 'Role harus berisi staff / user',
        ]);

        $updateData = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);

        if ($updateData) {
            return redirect()->route('admin.staffs.index')->with('success', 'Berhasil Mengupdate Data!!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Mengupdate Data!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteData = User::where('id', $id)->delete();
        if ($deleteData) {
            return redirect()->back()-> with('success', 'Berhasil Menghapus Data!!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Menghapus Data!!');
        }
    }

    public function export()
    {
        $tableName = 'data-Staff.xlsx';
        return Excel::download(new UserExport, $tableName);
    }

    public function trash()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.staff.trash', compact('users'));
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->find($id);
        $restore = $user->restore();
        if ($restore) {
            return redirect()->back()->with('success', 'Berhasil Mengembalikan Data!!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Mengembalikan Data!!');
        }
    }
    public function deletepermanent($id)
    {
        $user = User::onlyTrashed()->find($id);
        $deleteperma = $user->where('id', $id)->forceDelete();
        if ($deleteperma) {
            return redirect()->back()->with('success', 'Berhasil Menghapus Permanent Data!!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Menghapus Permanent Data!!');
        }
    }
}
