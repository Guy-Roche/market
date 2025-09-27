<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    //Expense methode
    public function index(){
        return view('admin.expenses');
    }//End method


    //Add Expense
    public function add(){
        return view('admin.expenses.add');
    }//End method

    //save expense
    public function save(Request $request)
    {
        // Create and save the expense
        $expense = new Expense();
        $expense->amount = $request->input('amount');
        $expense->details = $request->input('details');
        $expense->date = $request->input('date');
        $expense->month = $request->input('month');
        $expense->year = $request->input('year');
        $expense->save();

        // Redirect with success message
        $notification = array(
            'message' => 'Expense saved successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    //Today Expense
    public function today(){
        $compteur = 1  ;
        $date = date('d-m-Y');
        $expenses = Expense::where('date', $date)->latest()->get();
        //calculate total expenses of today
        $total = Expense::where('date', $date)->sum('amount');
        return view('admin.expenses.today', compact('expenses', 'compteur', 'total'));
    }//End method

    //Monthly Expense
    public function monthly(){
        $compteur = 1  ;
        $month = date('F');
        $expenses = Expense::where('month', $month)->latest()->get();
        //calculate total expenses of this month
        $total = Expense::where('month', $month)->sum('amount');
        return view('admin.expenses.monthly', compact('expenses', 'compteur', 'total'));
    }//End method

    //Yearly Expense
    public function yearly(){
        $compteur = 1  ;    
        $year = date('Y');
        $expenses = Expense::where('year', $year)->latest()->get();
        //calculate total expenses of this year
        $total = Expense::where('year', $year)->sum('amount');
        return view('admin.expenses.yearly', compact('expenses', 'compteur', 'total'));
    }//End method

    //Edit Expense
    public function edit($id){
        $expense = Expense::findOrFail($id);
        return view('admin.expenses.edit', compact('expense'));
    }//End method

    //Update Expense
    public function update(Request $request, $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->amount = $request->input('amount');
        $expense->details = $request->input('details');
        $expense->date = $request->input('date');
        $expense->month = $request->input('month');
        $expense->year = $request->input('year');
        $expense->save();

        // Redirect with success message
        $notification = array(
            'message' => 'Expense updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('expense.today')->with($notification);
    }
    //Delete Expense
    public function delete($id){
        $expense = Expense::findOrFail($id);
        $expense->delete(); 
        $notification = array(
            'message' => 'Expense deleted successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('expense.today')->with($notification);
    }//End method
}//End class
