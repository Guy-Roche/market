<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //Attendance list
    public function attendances()
    {
        $compteur = 1;
        $attendances = Attendance::select('date')->groupBy('date')->orderBy('id', 'desc')->get();
        return view('admin.attendances.attendances')
        ->with('attendances', $attendances)
        ->with('compteur', $compteur);
    }//end method

    //Add Attendance    
    public function add()
    {
        $compteur = 1;
        $employees = Employee::all();
        return view('admin.attendances.add')
            ->with('employees', $employees);
    }//end method

    //Save Attendance
    public function save(Request $request)
    {
        //si la date existe supprimer les lignes
        Attendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();
        //count employees
        $countemployee = count($request->employee_id);
        //validate request
        for ($i = 0; $i < $countemployee; $i++) {
            $attend_status = 'attend_status' . $i;
            $attend = new Attendance();
            $attend->employee_id = $request->employee_id[$i];
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
        $notification = array(
            'message' => 'Attendance recorded successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('attendances')->with($notification);
    }

    //Edit Attendance
    public function edit($date)
    {
        $employees = Employee::all();
        $attendances = Attendance::where('date', $date)->get();
        return view('admin.attendances.edit')
        ->with('attendances', $attendances)
        ->with('employees', $employees);
    }

    //View Attendance
    public function view($date)
    {
        $compteur = 1;
        //$employees = Employee::all();
        $attendances = Attendance::where('date', $date)->get();
        return view('admin.attendances.view')
        ->with('attendances', $attendances)
        ->with('compteur', $compteur);
    }

}
