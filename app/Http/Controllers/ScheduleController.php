<?php

namespace App\Http\Controllers;

use App\Exports\ScheduleExport;
use App\Models\field;
use App\Models\schedule;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fields = Field::all();
        $schedules = Schedule::with('field')->get();
        return view('staff.schedule.index', compact('fields', 'schedules'));
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
            'field_id' => 'required',
            'hours.*' =>   'required',
            'price_hourly' => 'required'
        ], [
            'field_id.required' => 'Nama lapangan wajib dipilih!',
            'hours.*.required' => 'Hours wajib diisi!!',
            'price_hourly.required' => 'Harga harus diisi!!'
        ]);

        $hours = Schedule::where('field_id', $request->field_id)->value('hour');
        $hourseBefore = $hours ?? [];
        $mergeHours = array_merge($hourseBefore, $request->hours);
        $newHours = array_unique($mergeHours);


        $createData = Schedule::updateOrCreate([
            'field_id' => $request->field_id,
        ], [
            'hourly_price' => $request->price_hourly,
            'hour' => $newHours,
        ]);

        if ($createData) {
            return redirect()->route('staff.schedules.index')->with('success', 'Berhasil Menambahakan Data!!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Menambahkan Data!!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(schedule $schedule, $id)
    {
        $schedule = Schedule::where('id', $id)->with('field')->first();
        return view('staff.schedule.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, schedule $schedule, $id)
    {
        $request->validate([
            'hours.*' =>   'required',
            'price_hourly' => 'required',
        ], [
            'hours.*.required' => 'Hours wajib diisi!!',
            'price_hourly.required' => 'Harga harus diisi!!'
        ]);

        $updateData = Schedule::where('id', $id)->update([
            'hour' => array_unique($request->hour),
            'hourly_price' => $request->price_hourly,
        ]);

        if ($updateData) {
            return redirect()->route('staff.schedules.index')->with('success', "Berhasil Mengupdate Data!!");
        } else {
            return redirect()->back()->with('failed', "Gagal Mengupdate Data!!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(schedule $schedule, $id)
    {
        $deleteData = Schedule::where('id', $id)->delete();

        if ($deleteData) {
            return redirect()->back()->with('success', 'Berhasil menghapus data');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }

    public function export() {
        $tableName = 'data-jadwal.xlsx';
        return Excel::download(new ScheduleExport, $tableName);
    }


    public function trash()
    {
        $schedules = schedule::onlyTrashed()->get();
        return view('staff.schedule.trash', compact('schedules'));
    }

    public function restore($id)
    {
        $restore = schedule::onlyTrashed()->where('id', $id)->restore();

        if ($restore) {
            return redirect()->back()->with('success', 'Berhasil mengembalikan data');
        } else {
            return redirect()->back()->with('error', 'Gagal mengembalikan data');
        }
    }

    public function deletepermanent($id)
    {
        $deletPermanentData = schedule::onlyTrashed()->where('id', $id)->forceDelete();

        if ($deletPermanentData) {
            return redirect()->back()->with('success', 'Berhasil menghapus data permanent');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
}
