<?php

namespace App\Http\Controllers;

use App\Exports\FieldsExport;
use App\Models\field;
use App\Models\schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function home(){
        $schedules = Schedule::with('field')->orderBy('created_at','DESC')->limit(3)->get();
        return view('home', compact('schedules'));
    }

    public function fielddetail($id){
        $schedule= Schedule::where('id',$id)->with('field')->first();
        return view('fieldDetail.fielddetail',compact('schedule'));
    }

    public function index()
    {
        $fields = Field::all();
        return view('admin.field.index', compact('fields'));
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
            'name' => 'required|min:2',
            'picture' => 'required|mimes:png,jpg,svg',
            'type' => 'required|in:indoor,outdoor',
            'description' => 'required|min:10'
        ], [
            'name.required' => 'Nama harus diisi!',
            'name.min' => 'Nama minimal 2 karakter!',
            'picture' => 'Picture wajib diisi!',
            'picture.mimes' => 'Picture harus png,jpg,svg',
            'type.required' => 'Type harus diisi!!',
            'type.in' => 'Type harus indoor/outdoor',
            'description.required' => 'Description harus diisi!',
            'description.min' => 'Description minimal 10 karakter!!'
        ]);

        $picture = $request->file('picture');
        $namaGambar = Str::random(5) . "-picture." . $picture->getClientOriginalExtension();
        $path = $picture->storeAs('picture', $namaGambar, 'public');
        $createData = Field::create([
            'name' => $request->name,
            'picture' => $path,
            'type' => $request->type,
            'description' => $request->description
        ]);

        if ($createData) {
            return redirect()->back()->with('success', 'Berhasil membuat akun silahkan login!!');
        } else {
            return redirect()->back()->with('failed', 'Gagal membuat akun!!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(field $field)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(field $field, $id)
    {
        $field = Field::find($id);
        return view('admin.field.edit', compact('field'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, field $field, $id)
    {
        $request->validate([
            'name' => 'required|min:2',
            'picture' => '|mimes:png,jpg,svg',
            'type' => 'required|in:indoor,outdoor',
            'description' => 'required|min:10'
        ], [
            'name.required' => 'Nama harus diisi!',
            'name.min' => 'Nama minimal 2 karakter!',
            'picture' => 'Picture wajib diisi!',
            'picture.mimes' => 'Picture harus png,jpg,svg',
            'type.required' => 'Type harus diisi!!',
            'type.in' => 'Type harus indoor/outdoor',
            'description.required' => 'Description harus diisi!',
            'description.min' => 'Description minimal 10 karakter!!'
        ]);

        $field = Field::find($id);
        // jika ada file picture baru
        if ($request->file('picture')) {
            $fileSebelumnya = storage_path("app/public/" . $field->picture);
            if (file_exists($fileSebelumnya)) {
                // unlink() : hapus
                unlink($fileSebelumnya);
            }
            $picture = $request->file('picture');
            $namapicture = Str::random(5) . "-picture." . $picture->getClientOriginalExtension();
            $path = $picture->storeAs("picture", $namapicture, "public");
        }

        $updateData = Field::where('id', $id)->update([
            'name' => $request->name,
            'picture' => $path ?? $field->picture,
            'type' => $request->type,
            'description' => $request->description
        ]);

        if ($updateData) {
            return redirect()->route('admin.fields.index')->with('success', 'Berhasil membuat akun silahkan login!!');
        } else {
            return redirect()->back()->with('failed', 'Gagal membuat akun!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(field $field, $id)
    {
        $delteData = Field::where('id', $id)->delete();
        if ($delteData) {
            return redirect()->back()->with('success', 'Berhasil membuat akun silahkan login!!');
        } else {
            return redirect()->back()->with('failed', 'Gagal membuat akun!!');
        }
    }

    public function export()
    {
        $dataName = 'data-Field.xlsx';
        return Excel::download(new FieldsExport, $dataName);
    }

    public function trash()
    {
        $fields = Field::onlyTrashed()->get();
        return view('admin.field.trash', compact('fields'));
    }

    public function restore($id)
    {
        $field = Field::onlyTrashed()->find($id);
        $restore = $field->restore();
        if ($restore) {
            return redirect()->back()->with('success', 'Berhasil Mengembalikan Data!!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Mengembalikan Data!!');
        }
    }
    public function deletepermanent($id)
    {
        $field = Field::onlyTrashed()->find($id);
        $fileSebelumnya = storage_path("app/public/" . $field->picture);
        if (file_exists($fileSebelumnya)) {
            // unlink() : hapus
            unlink($fileSebelumnya);
        }
        $deleteperma = $field->forceDelete();
        if ($deleteperma) {
            return redirect()->back()-> with('success', 'Berhasil Menghapus Permanent Data!!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Menghapus Permanent Data!!');
        }
    }
}
