<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
  
    // login page
    public function login()
    {
        return view('auth.login');
    }
    //dashboard
    public function dashboard()
    {
        $date = date('d-m-Y');
        $todayPaid = Order::where('order_date', $date)->where('payment_status', 'Paid')->sum('pay');
        $totalPaid = Order::sum('pay');
        $totalDue = Order::sum('due');
        $CompletedOrders = Order::where('order_status', 'Completed')->get();
        $pendingOrders = Order::where('order_status', 'pending')->get();

        return view('index')
        ->with('todayPaid', $todayPaid)
        ->with('totalPaid', $totalPaid)
        ->with('totalDue', $totalDue)
        ->with('CompletedOrders', $CompletedOrders)
        ->with('pendingOrders', $pendingOrders);
    }

    //Logout the user
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array('message' => 'User Logout Successfully', 'alert-type' => 'info');

        return redirect('/admin/logoutpage')->with($notification);
    }

    //Logout page
    public function logoutPage()
    {
        return view('admin.logoutpage');
    }

    //Affichage de la page de profil
    public function profile()
    {
        $user = Auth::user()->id;
        $adminData = User::find($user);
        return view('admin.view_profile')
        ->with('adminData', $adminData);
    }

    //Mise à jour du profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:15',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],
        [
            'name.required' => 'Veuillez entrer votre nom',
            'email.required' => 'Veuillez entrer votre email',
            'phone.required' => 'Veuillez entrer votre numéro de téléphone',
            'photo.image' => 'La photo de profil doit être une image',
            'photo.mimes' => 'La photo de profil doit être un fichier de type : jpeg, png, jpg, gif',
            'photo.max' => 'La photo de profil ne doit pas dépasser 2 Mo',
        ]
        );
        $currentUser = Auth::user()->id;
        $user = User::find($currentUser);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->file('photo')) {
                # code...
                $this->validate($request, [
                'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'photo.image' => 'La photo de profil doit être une image',
                'photo.mimes' => 'La photo de profil doit être un fichier de type : jpeg, png, jpg',
                'photo.max' => 'La photo de profil ne doit pas dépasser 2 Mo',
            ]);
                        // 📥 Récupération du fichier
                $profileImage = $request->file('photo');

                // 📛 Nom original et extension
                $originalName = $profileImage->getClientOriginalName();
                $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);
                $extension = $profileImage->getClientOriginalExtension();

                // 🆕 Nom unique
                $profileImageName = $nameWithoutExt . '_' . time() . '.' . $extension;

                // 📁 Dossier cible
                $destinationPath = public_path('backend/images/users');

                // 📂 Création du dossier si nécessaire
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }

                // 🗑️ Suppression de l’ancienne image
                $oldImagePath = $destinationPath . '/' . $user->photo;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }

                // 📤 Déplacement du nouveau fichier
                $profileImage->move($destinationPath, $profileImageName);

                // 🖊️ Mise à jour du modèle
                $user->photo = $profileImageName;

        }

        $user->update();

        $notification = array('message' => 'Profile Updated Successfully', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    //change password
    public function changepwd()
    {
        $user = Auth::user()->id;
        $adminData = User::find($user);
        return view('admin.change_pwd')
        ->with('adminData', $adminData);
    }


    //update password
    public function updatepwd(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ],
        [
            'old_password.required' => 'Veuillez entrer votre ancien mot de passe',
            'new_password.required' => 'Veuillez entrer votre nouveau mot de passe',
            'new_password.confirmed' => 'La confirmation du nouveau mot de passe ne correspond pas',
        ]
        );
        $user = User::find(Auth::user()->id);

        //VVerifier si le mot de passe est correct avec celui en base
        if (Hash::check($request->old_password, $user->password)) {

            //Mettre à jour le mot de passe
            $user->password = Hash::make($request->new_password);
            $user->update();
            $notification = array('message' => 'Password Updated Successfully', 'alert-type' => 'success');

        }else {
            //Le mot de passe ne correspond pas
            $notification = array('message' => 'Old Password does not match!', 'alert-type' => 'error');
        }

            return back()->with($notification);
    }   // end method

    //-------- Admin User All method ----------
    public function adminusers()
    {
        $compteur = 1;
        $adminUsers = User::latest()->get();
        return view('admin.useradmin.index', compact('adminUsers', 'compteur'));
    }// end method

    public function addadmin()
    {
        //get roles
        $roles =  Role::all();
        // dd($roles);
        return view('admin.useradmin.add', compact('roles'));
    }// end method

    //Save New Admin User
    public function saveadminuser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        //Hash password
        $user->password = Hash::make($request->password);
        //Save user
        $user->save();
        //Assign Role to new user
        if ($request->roles) {
            $role = Role::find($request->roles);
            $user->assignRole($role->name);
        }
        $notification = array('message' => 'New Admin User Created Successfully', 'alert-type' => 'success');
        return redirect()->route('adminusers')->with($notification);
    }    // end method

    //Edit Admin User
    public function editadminuser($id)
    {
        $adminUser = User::find($id);
        //get roles
        $roles =  Role::all();
        return view('admin.useradmin.edit', compact('adminUser', 'roles'));
    } // end method

    //Update Admin User
    public function updateadminuser(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        //Update user
        $user->update();
        //detach all roles
        $user->roles()->detach();
        //Assign Role to new user
        if ($request->roles) {
            $role = Role::find($request->roles);
            $user->assignRole($role->name);
        }
        $notification = array('message' => 'Admin User Updated Successfully', 'alert-type' => 'success');
        return redirect()->route('adminusers')->with($notification);
    } // end method

    //Delete Admin User
    public function deleteadminuser($id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            //delete user
            $user->delete();    
            $notification = array('message' => 'Admin User Deleted Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }else {
            $notification = array('message' => 'Admin User Not Found', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    } // end method

    //************ Database Backup Methods************//
    //Database Backup
    public function databasebackup()
    {
        // Logic for database backup
        $compteur = 1;
        return view('admin.db_backup.index')
        ->with('files', File::allFiles(storage_path('app/Market')))
        ->with('compteur', $compteur);
    }
    // Method Database now
      // Download a zip containing all SQL backup files
    public function databasebackupnow()
    {
        //// Backup complet (fichiers + base de données)
        Artisan::call('backup:run');
        $notification = array('message' => 'Database Backup Generated Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    
    }


    public function databasedelete($getFilename)
    {
        // Logic for deleting a specific database backup
        $filePath = storage_path('app\Market/' . $getFilename);
        if (File::exists($filePath)) {
            File::delete($filePath);
            $notification = array('message' => 'Database Backup Deleted Successfully', 'alert-type' => 'success');
        } else {
            $notification = array('message' => 'Database Backup Not Found', 'alert-type' => 'error');
        }
        return redirect()->back()->with($notification);
    }

    public function databasedownload($getFilename)
    {
        // Logic for downloading a specific database backup
        $filePath = storage_path('app\Market/' . $getFilename);
        if (File::exists($filePath)) {
            return response()->download($filePath);
        } else {
            $notification = array('message' => 'Database Backup Not Found', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
    //************ End Database Backup Methods************//
}