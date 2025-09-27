<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    //Afficher tous les employés
    public function employees()
    {
        $compteur = 1;
        $employees = Employee::latest()->get();
        return view('admin.employees.employees')
            ->with('employees', $employees)
            ->with('compteur', $compteur);
    }

    //Ajouter un nouvel employé
    public function addemployee()
    {
        return view('admin.employees.add_employee');
    }

    //Sauvegarder un employé
    public function saveemployee(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:employees',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'salary' => 'required|string|max:20',
                'vacation' => 'required|string|max:20',
            ],
            [
                'name.required' => 'Name is required.',
                'email.required' => 'Email is required.',
                'phone.required' => 'Phone number is required.',
                'address.required' => 'Address is required.',
                'salary.required' => 'Salary is required.',
                'vacation.required' => 'Vacation is required.',
            ]
        );

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->adress;
        $employee->experience = $request->experience;
        $employee->salary = $request->salary;
        $employee->vacation = $request->vacation;
        $employee->city = $request->city;
        if ($request->file('image')) {
            # code...
            $this->validate(
                $request,
                [
                    'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                ],
                [
                    'image.image' => 'La photo de l\'employé doit être une image',
                    'image.mimes' => 'La photo de l\'employé doit être un fichier de type : jpeg, png, jpg',
                    'image.max' => 'La photo de l\'employé ne doit pas dépasser 2 Mo',
                ]
            );
            // 📥 Récupération du fichier
            $profileImage = $request->file('image');

            // 📛 Nom original et extension
            $originalName = $profileImage->getClientOriginalName();
            $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $profileImage->getClientOriginalExtension();

            // 🆕 Nom unique
            $profileImageName = $nameWithoutExt . '_' . time() . '.' . $extension;

            // 📁 Dossier cible
            $destinationPath = public_path('backend/images/employees');

            // 📂 Création du dossier si nécessaire
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // 🗑️ Suppression de l’ancienne image
            $oldImagePath = $destinationPath . '/' . $employee->image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // 📤 Déplacement du nouveau fichier
            $profileImage->move($destinationPath, $profileImageName);

            // 🖊️ Mise à jour du modèle
            $employee->image = $profileImageName;
        }
        $employee->save();
        $notification = array('message' => 'Employee added successfully.', 'alert-type' => 'success');
        return redirect()->route('admin.employees')->with($notification);
    }

    //editer un employé
    public function editemployee($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.employees.edit_employee')->with('employee', $employee);
    }

    //Mettre à jour les données de l'employée
    public function updateemployee(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:employees,email,' . $id,
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'salary' => 'required|string|max:20',
                'vacation' => 'required|string|max:20',
            ],
            [
                'name.required' => 'Name is required.',
                'email.required' => 'Email is required.',
                'phone.required' => 'Phone number is required.',
                'address.required' => 'Address is required.',
                'salary.required' => 'Salary is required.',
                'vacation.required' => 'Vacation is required.',
            ]
        );

        $employee = Employee::findOrFail($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->experience = $request->experience;
        $employee->salary = $request->salary;
        $employee->vacation = $request->vacation;
        $employee->city = $request->city;
        if ($request->file('image')) {
            # code...
            $this->validate(
                $request,
                [
                    'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                ],
                [
                    'image.image' => 'La photo de l\'employé doit être une image',
                    'image.mimes' => 'La photo de l\'employé doit être un fichier de type : jpeg, png, jpg',
                    'image.max' => 'La photo de l\'employé ne doit pas dépasser 2 Mo',
                ]
            );
            // 📥 Récupération du fichier
            $profileImage = $request->file('image');

            // 📛 Nom original et extension
            $originalName = $profileImage->getClientOriginalName();
            $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $profileImage->getClientOriginalExtension();

            // 🆕 Nom unique
            $profileImageName = $nameWithoutExt . '_' . time() . '.' . $extension;

            // 📁 Dossier cible
            $destinationPath = public_path('backend/images/employees');

            // 📂 Création du dossier si nécessaire
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // 🗑️ Suppression de l’ancienne image
            $oldImagePath = $destinationPath . '/' . $employee->image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // 📤 Déplacement du nouveau fichier
            $profileImage->move($destinationPath, $profileImageName);

            // 🖊️ Mise à jour du modèle
            $employee->image = $profileImageName;
        }
        $employee->update();
        $notification = array('message' => 'Employee updated successfully.', 'alert-type' => 'success');
        return redirect()->route('admin.employees')->with($notification);
    }
    //Supprimer un employé
    public function deleteemployee($id)
    {
        $employee = Employee::findOrFail($id);

        // Supprimer la photo de l'utilisateur
        $oldImagePath = public_path('backend/images/employees/' . $employee->image);
        if (File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        }
        $employee->delete();

        $notification = array('message' => 'Employee deleted successfully.', 'alert-type' => 'success');
        return redirect()->route('admin.employees')->with($notification);
    }
}
