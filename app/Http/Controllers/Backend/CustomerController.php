<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    //Liste des customers
    public function customers(){
        $customers = Customer::latest()->get();
        $compteur = 1;
        return view('admin.customers.customers') 
         ->with('customers', $customers)
         ->with('compteur', $compteur);
    }
    //Ajouter un customer
    public function addcustomer(){
        return view('admin.customers.add_customer');

    }
    //Enregistrer un customer
    public function savecustomer(Request $request){
        $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:customers|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'shopname' => 'required|max:200',
            'account_holder' => 'required|max:200', 
            'account_number' => 'required', ],
            [
                'name.required' => 'Please enter customer name',
                'email.required' => 'Please enter customer email',
                'email.unique' => 'This email is already used',
                'phone.required' => 'Please enter customer phone',
                'address.required' => 'Please enter customer address',
                'shopname.required' => 'Please enter customer shop name',
                'account_holder.required' => 'Please enter account holder name',
                'account_number.required' => 'Please enter account number',
            ]
        );
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->shopname = $request->shopname;
        $customer->account_holder = $request->account_holder;
        $customer->account_number = $request->account_number;
        $customer->bank_name = $request->bank_name;
        $customer->bank_branch = $request->bank_branch;
        $customer->city = $request->city;
        //image upload
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
            $destinationPath = public_path('backend/images/customers');

            // 📂 Création du dossier si nécessaire
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // 🗑️ Suppression de l’ancienne image
            $oldImagePath = $destinationPath . '/' . $customer->image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // 📤 Déplacement du nouveau fichier
            $profileImage->move($destinationPath, $profileImageName);

            // 🖊️ Mise à jour du modèle
            $customer->image = $profileImageName;
        }
        $customer->save();
        $notification = array(
            'message' => 'Customer added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.customers')->with($notification);
    }    

    //Editer un customer
    public function editcustomer($id){
        $customer = Customer::findOrFail($id);
        return view('admin.customers.edit_customer')->with('customer', $customer);  
    }
    //Mettre à jour un customer
    public function updatecustomer(Request $request, $id){
        $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|max:200|unique:customers,email,'.$id,
            'phone' => 'required|max:200',  
            'address' => 'required|max:400',
            'shopname' => 'required|max:200',
            'account_holder' => 'required|max:200', 
            'account_number' => 'required', ],      
            [
                'name.required' => 'Please enter customer name',
                'email.required' => 'Please enter customer email',
                'email.unique' => 'This email is already used',
                'phone.required' => 'Please enter customer phone',
                'address.required' => 'Please enter customer address',
                'shopname.required' => 'Please enter customer shop name',
                'account_holder.required' => 'Please enter account holder name',
                'account_number.required' => 'Please enter account number',
            ]
        );
        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->shopname = $request->shopname;
        $customer->account_holder = $request->account_holder;
        $customer->account_number = $request->account_number;
        $customer->bank_name = $request->bank_name;
        $customer->bank_branch = $request->bank_branch;
        $customer->city = $request->city;
        //image upload
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
            $destinationPath = public_path('backend/images/customers');

            // 📂 Création du dossier si nécessaire
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // 🗑️ Suppression de l’ancienne image
            $oldImagePath = $destinationPath . '/' . $customer->image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // 📤 Déplacement du nouveau fichier
            $profileImage->move($destinationPath, $profileImageName);

            // 🖊️ Mise à jour du modèle
            $customer->image = $profileImageName;
        }
        $customer->update();
        $notification = array(
            'message' => 'Customer updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.customers')->with($notification);
    }
    //Supprimer un customer
    public function deletecustomer($id){
        $customer = Customer::findOrFail($id);
        // Supprimer la photo de l'utilisateur
        $oldImagePath = public_path('backend/images/customers/' . $customer->image);
        if (File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        }
        $customer->delete();
        $notification = array(
            'message' => 'Customer deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.customers')->with($notification);
    }
}  