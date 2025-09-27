<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdvanceSalary;
use App\Models\Employee;
use App\Models\PaySalary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    //All Advance Salaries
    public function advance_salaries()
    {
        $compteur = 1;
        $salaries = AdvanceSalary::all();
        return view('admin.salaries.salaries', compact('salaries', 'compteur'));
    }

    public function add_advance_salary()
    {
        $employees = Employee::latest()->get();
        return view('admin.salaries.add_advance_salary', compact('employees'));
    }

    public function save_advance_salary(Request $request)
    {
        $request->validate(
            [
                'month' => 'required|max:255',
                'year' => 'required|max:255',
                // 'advance_salary' => 'required|max:255',
            ],
            [
                'month.required' => 'The month field is required.',
                'year.required' => 'The year field is required.',
                // 'advance_salary.required' => 'The advance salary field is required.',
            ]
        );

        //save advance salary
        $advance_salary = new AdvanceSalary();
        $advance_salary->employee_id = $request->employee;
        //Check if employee doesn't have an advance salary for the selected month and year
        $advance = AdvanceSalary::where('employee_id', $request->employee)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->first();

        if ($advance === null) {
            $advance_salary->month = $request->month;
            $advance_salary->year = $request->year;
            $advance_salary->advance_salary = $request->advance_salary;
            $advance_salary->save();
            $notification = array(
                'message' => 'Salary added successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            # code...
            $notification = array(
                'message' => 'Advance salary for this month and year already paid.',
                'alert-type' => 'error'
            );
        return redirect()->route('admin.advance_salaries')->with($notification);
        }
    }

    //edit Advance Salary
    public function edit_advance_salary($id)
    {
        $advance_salary = AdvanceSalary::findOrFail($id);
        // Get all employees without employee advance salary
        //$employees = Employee::where('id', '!=', $advance_salary->employee_id)->get();
        $employees = Employee::latest()->get();
        return view('admin.salaries.edit_advance_salary', compact('advance_salary', 'employees'));
    }

    //update Advance Salary
    public function update_advance_salary(Request $request, $id)
    {
        $request->validate([
                'month' => 'required|max:255',
                'year' => 'required|max:255',
                // 'advance_salary' => 'required|max:255',
        ],[
            'month.required' => 'The month field is required.',
            'year.required' => 'The year field is required.',
            // 'advance_salary.required' => 'The advance salary field is required.',
        ]);

        $advance_salary = AdvanceSalary::findOrFail($id);
        $advance_salary->employee_id = $request->employee;
        $advance_salary->month = $request->month;
        $advance_salary->year = $request->year;
        $advance_salary->advance_salary = $request->advance_salary;
        $advance_salary->update();
        $notification = array(
            'message' => 'Advances salary updated successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.advance_salaries')->with($notification);
    }

    public function deletesalary($id)
    {
        $salary = AdvanceSalary::findOrFail($id);
        $salary->delete();
        $notification = array(
            'message' => 'Advance salary deleted successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.advance_salaries')->with($notification);
    }//end method

    /////// Pay Salary Method  //////
    public function pay_salary()
    {
        $compteur = 1;
        $employees = Employee::latest()->get();
        return view('admin.salaries.pay_salary', compact('employees', 'compteur'));
    }

    //pay now salary
    public function pay_now_salary($id)
    {
        $paidsalary = Employee::findOrFail($id);
        // Logic to process the salary payment
        return view('admin.salaries.paid_salary')->with('paidsalary', $paidsalary);
    }

    //save paid salary
    public function save_paid_salary(Request $request)
    {
        // Validate the request data

        $paidsalary = new PaySalary();
        $paidsalary->employee_id = $request->id;
        $paidsalary->salary_month = $request->salary_month;
        $paidsalary->paid_amount = $request->paid_amount;
        $paidsalary->advance_salary = $request->advance_salary;
        $paidsalary->due_salary = $request->due_salary;
        $paidsalary->save();

        // Logic to save the paid salary details
        // For example, you might want to create a new SalaryPayment record
        // SalaryPayment::create([
        //     'employee_id' => $request->employee_id,
        //     'paid_amount' => $request->paid_amount,
        //     'advance_salary' => $request->advance_salary,
        //     'due_salary' => $request->due_salary,
        //     'payment_date' => $request->payment_date,
        // ]);

        $notification = array(
            'message' => 'Salary paid successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.pay_salary')->with($notification);
    } //end method

    //Last month salary
    public function lastmonthsalary()
    {
        $compteur = 1;
        $paidsalaries = PaySalary::latest()->get();
        return view('admin.salaries.last_month_salary', compact('paidsalaries', 'compteur'));
    }

    //History of Paid Salary
    public function historypaid($id)
    {
        $paidsalary = PaySalary::findOrFail($id);
        return view('admin.salaries.history', compact('paidsalary'));
    }

}