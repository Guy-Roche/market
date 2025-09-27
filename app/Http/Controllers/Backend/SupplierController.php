<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SupplierController extends Controller
{
    //List Suppliers
    public function suppliers()
    {
        $compteur = 1;
        $suppliers = Supplier::latest()->get();
        return view('admin.suppliers.suppliers', compact('suppliers', 'compteur'));
    }

    //Add Supplier
    public function addsupplier()
    {
        return view('admin.suppliers.add_supplier');
    }

    //save supplier
    public function savesupplier(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:suppliers|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'type' => 'required|max:200',
            'shopname' => 'required|max:200',
            'account_holder' => 'required|max:200',
            'account_number' => 'required|max:200',
        ], [
            'name.required' => 'Please enter supplier name',
            'email.required' => 'Please enter supplier email',
            'email.unique' => 'This email is already used',
            'phone.required' => 'Please enter supplier phone number',
            'phone.unique' => 'This phone number is already used',
            'address.required' => 'Please enter supplier address',
            'type.required' => 'Please enter supplier type',
            'shopname.required' => 'Please enter supplier shop name',
            'account_holder.required' => 'Please enter account holder name',
            'account_number.required' => 'Please enter account number',
        ]);
        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->type = $request->type;
        $supplier->shopname = $request->shopname;
        $supplier->account_holder = $request->account_holder;
        $supplier->account_number = $request->account_number;
        $supplier->bank_name = $request->bank_name;
        $supplier->bank_branch = $request->bank_branch;
        $supplier->city = $request->city;

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
            $destinationPath = public_path('backend/images/suppliers');

            // 📂 Création du dossier si nécessaire
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // 🗑️ Suppression de l’ancienne image
            $oldImagePath = $destinationPath . '/' . $profileImageName;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // 📤 Déplacement du nouveau fichier
            $profileImage->move($destinationPath, $profileImageName);

            // 🖊️ Mise à jour du modèle
            $supplier->image = $profileImageName;
        }
        //save data
        $supplier->save();

        $notification = array(
            'message' => 'Supplier Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.suppliers')->with($notification);
    }
    //edit supplier
    public function editsupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit_supplier', compact('supplier'));
    }

    //update supplier
    public function updatesupplier(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|max:200|unique:suppliers,email,' . $id,
            'phone' => 'required|max:200|unique:suppliers,phone,' . $id,
            'address' => 'required|max:400',
            'type' => 'required|max:200',
            'shopname' => 'required|max:200',
            'account_holder' => 'required|max:200',
            'account_number' => 'required|max:200',
        ], [
            'name.required' => 'Please enter supplier name',
            'email.required' => 'Please enter supplier email',
            'email.unique' => 'This email is already used',
            'phone.required' => 'Please enter supplier phone number',
            'phone.unique' => 'This phone number is already used',
            'address.required' => 'Please enter supplier address',
            'type.required' => 'Please enter supplier type',
            'shopname.required' => 'Please enter supplier shop name',
            'account_holder.required' => 'Please enter account holder name',
            'account_number.required' => 'Please enter account number',
        ]);
        $supplier = Supplier::findOrFail($id);
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->type = $request->type;
        $supplier->shopname = $request->shopname;
        $supplier->account_holder = $request->account_holder;
        $supplier->account_number = $request->account_number;
        $supplier->bank_name = $request->bank_name;
        $supplier->bank_branch = $request->bank_branch;
        $supplier->city = $request->city;

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
                    'image.mimes' => 'La photo de l\'employé doit être au format jpeg, png ou jpg',
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
            $oldImagePath = $destinationPath . '/' . $supplier->image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // 📤 Déplacement du nouveau fichier
            $profileImage->move($destinationPath, $profileImageName);

            // 🖊️ Mise à jour du modèle
            $supplier->image = $profileImageName;
        }

        // Enregistrement des modifications
        $supplier->update();

        $notification = array(
            'message' => 'Fournisseur mis à jour avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.suppliers')->with($notification);
    }   

    //delete supplier
    public function deletesupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        //supprimer photo
        $oldImagePath = public_path('backend/images/suppliers/' . $supplier->image);
        if (File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        }
        $supplier->delete();

        $notification = array(
            'message' => 'Fournisseur supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.suppliers')->with($notification);
    }

    //details supplier
    public function detailsupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.details_supplier', compact('supplier'));
    }

}
