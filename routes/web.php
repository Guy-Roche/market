<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ControllerCategory;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('index');
// })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/logoutpage', [AdminController::class, 'logoutpage'])->name('admin.logoutpage');

//protéger les routes admin
//se connecter avant d'avoir accès
Route::middleware(['auth', 'verified'])->group(function () {
    //dashboard Route
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::put('/admin/updateprofile', [AdminController::class, 'updateprofile'])->name('admin.updateprofile');
    Route::delete('/admin/profile', [AdminController::class, 'destroy'])->name('admin.profile.destroy');
    Route::get('/admin/changepwd', [AdminController::class, 'changepwd'])->name('admin.changepwd');
    Route::put('/admin/updatepwd', [AdminController::class, 'updatepwd'])->name('admin.updatepwd');


    //employee Route
    Route::controller(EmployeeController::class)->group(function(){
        Route::get('/admin/employees', 'employees')->name('admin.employees')->middleware('permission:employees.all');
        Route::get('/admin/addemployee', 'addemployee')->name('admin.addemployee')->middleware('permission:employee.add');
        Route::post('/admin/saveemployee', 'saveemployee')->name('admin.saveemployee')->middleware('permission:employee.add');
        Route::get('/admin/editemployee/{id}', 'editemployee')->name('admin.editemployee')->middleware('permission:employee.edit');
        Route::put('/admin/updateemployee/{id}', 'updateemployee')->name('admin.updateemployee')->middleware('permission:employee.edit');
        Route::get('/admin/deleteemployee/{id}', 'deleteemployee')->name('admin.deleteemployee')->middleware('permission:employee.delete');
    });

    //Customers Route
    Route::controller(CustomerController::class)->group(function(){
        Route::get('/admin/customers', 'customers')->name('admin.customers');
        Route::get('/admin/addcustomer', 'addcustomer')->name('admin.addcustomer');
        Route::post('/admin/savecustomer', 'savecustomer')->name('admin.savecustomer');
        Route::get('/admin/editcustomer/{id}', 'editcustomer')->name('admin.editcustomer');
        Route::put('/admin/updatecustomer/{id}', 'updatecustomer')->name('admin.updatecustomer');
        Route::get('/admin/deletecustomer/{id}', 'deletecustomer')->name('admin.deletecustomer');
    });

     //Suppliers Route
    Route::controller(SupplierController::class)->group(function(){
        Route::get('/admin/suppliers', 'suppliers')->name('admin.suppliers');
        Route::get('/admin/addsupplier', 'addsupplier')->name('admin.addsupplier');
        Route::post('/admin/savesupplier', 'savesupplier')->name('admin.savesupplier');
        Route::get('/admin/editsupplier/{id}', 'editsupplier')->name('admin.editsupplier');
        Route::put('/admin/updatesupplier/{id}', 'updatesupplier')->name('admin.updatesupplier');
        Route::get('/admin/deletesupplier/{id}', 'deletesupplier')->name('admin.deletesupplier');
        Route::get('/admin/detailsupplier/{id}', 'detailsupplier')->name('admin.detailsupplier');
    });
    //Employee Advance Salary Route
    Route::controller(SalaryController::class)->group(function(){
        Route::get('/admin/advance_salaries', 'advance_salaries')->name('admin.advance_salaries');
        Route::get('/admin/addsalary', 'add_advance_salary')->name('admin.add_advance_salary');
        Route::post('/admin/save_advance_salary', 'save_advance_salary')->name('admin.save_advance_salary');
        Route::get('/admin/edit_advance_salary/{id}', 'edit_advance_salary')->name('admin.edit_advance_salary');
        Route::put('/admin/update_advance_salary/{id}', 'update_advance_salary')->name('admin.update_advance_salary');
        Route::get('/admin/delete_advance_salary/{id}', 'delete_advance_salary')->name('admin.delete_advance_salary');

        //Pay Salary
        Route::get('/admin/pay_salary', 'pay_salary')->name('admin.pay_salary');
        Route::get('/admin/pay_now_salary/{id}', 'pay_now_salary')->name('admin.pay_now_salary');
        Route::post('/admin/save_paid_salary', 'save_paid_salary')->name('admin.save_paid_salary');
        Route::get('/admin/lastmonthsalary', 'lastmonthsalary')->name('admin.lastmonthsalary');
        Route::get('/admin/historypaid/{id}', 'historypaid')->name('admin.historypaid');
    });

    //Attendance Route
            Route::controller(AttendanceController::class)->group(function(){
                Route::get('/admin/attendances', 'attendances')->name('attendances');
                Route::get('/admin/attendance/add', 'add')->name('attendance.add');
                Route::get('/admin/attendance/view/{date}', 'view')->name('attendance.view');
                Route::post('/admin/attendance/save', 'save')->name('attendance.save');
                Route::get('/admin/attendance/edit/{date}', 'edit')->name('attendance.edit');
                Route::put('/admin/attendance/view/{date}', 'view')->name('attendance.view');
                Route::get('/admin/attendance/delete/{date}', 'delete')->name('attendance.delete');
            });

    //categories Route
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/categories', 'categories')->name('categories');
        Route::get('/admin/category/add', 'add')->name('category.add');
        Route::post('/admin/category/save', 'save')->name('category.save');
        Route::get('/admin/category/edit/{id}', 'edit')->name('category.edit');
        Route::put('/admin/category/update/{id}', 'update')->name('category.update');
        Route::get('/admin/category/delete/{id}', 'delete')->name('category.delete');
    });

    //Products Route
    Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/products', 'products')->name('products');
        Route::get('/admin/product/add', 'add')->name('product.add');
        Route::post('/admin/product/save', 'save')->name('product.save');
        Route::get('/admin/product/edit/{id}', 'edit')->name('product.edit');
        Route::get('/admin/product/show/{id}', 'show')->name('product.show');
        Route::put('/admin/product/update/{id}', 'update')->name('product.update');
        Route::get('/admin/product/delete/{id}', 'delete')->name('product.delete');
        Route::get('/admin/product/import', 'import')->name('product.import');
        Route::get('/admin/product/export', 'export')->name('product.export');
        Route::post('/admin/product/imported', 'imported')->name('product.imported');
    });

    //Expense Route
    Route::controller(ExpenseController::class)->group(function(){
        Route::get('/admin/expense', 'expenes')->name('expenses');
        Route::get('/admin/expense/add', 'add')->name('expense.add');
        Route::post('/admin/expense/save', 'save')->name('expense.save');
        Route::get('/admin/expense/today', 'today')->name('expense.today');
        Route::get('/admin/expense/monthly', 'monthly')->name('expense.monthly');
        Route::get('/admin/expense/yearly', 'yearly')->name('expense.yearly');
        Route::get('/admin/expense/edit/{id}', 'edit')->name('expense.edit');
        Route::put('/admin/expense/update/{id}', 'update')->name('expense.update');
        Route::get('/admin/expense/delete/{id}', 'delete')->name('expense.delete');
    });

    //POS Route
    Route::controller(PosController::class)->group(function(){
        Route::get('/admin/pos', 'pos')->name('pos');
        Route::post('/admin/pos/addcart', 'addcart')->name('pos.addcart');
        Route::put('/admin/pos/updatecart/{rowId}', 'updatecart')->name('pos.updatecart');
        Route::get('/admin/pos/deletecart/{rowId}', 'deletecart')->name('pos.deletecart');
        Route::post('/admin/pos/createinvoice', 'createinvoice')->name('pos.createinvoice');
    });


    //Order Route 

    Route::controller(OrderController::class)->group(function(){
        Route::post('/admin/order/save', 'save')->name('order.save');
        Route::get('/admin/order/pending', 'pendingOrders')->name('order.pending');
        Route::get('/admin/order/completed', 'completedOrders')->name('order.completed');
        Route::get('/admin/order/details/{id}', 'viewDetails')->name('order.details');
        Route::put('/admin/order/status/update/{id}', 'updateStatus')->name('order.status.update');
        Route::get('/admin/stock/manage', 'stockManage')->name('stock.manage');
        Route::get('/admin/order/invoice/download/{id}', 'invoiceDownload')->name('order.invoice.download');

        //Payment Due Route
        Route::get('/admin/pending/due', 'pendingDue')->name('pending.due');
        Route::get('/admin/order/due/{id}', 'orderDue')->name('order.due');
        Route::post('/admin/order/due/pay', 'orderDuePay')->name('order.due.pay');
    });

    //Persmissions Route
    Route::controller(RoleController::class)->group(function(){
        Route::get('/admin/permissions', 'permissions')->name('permissions');
        Route::get('/admin/permission/add', 'add')->name('permission.add');
        Route::post('/admin/permission/save', 'save')->name('permission.save');
        Route::get('/admin/permission/edit/{id}', 'edit')->name('permission.edit');
        Route::put('/admin/permission/update/{id}', 'update')->name('permission.update');
        Route::get('/admin/permission/delete/{id}', 'delete')->name('permission.delete');
    });

        //Roles Route
    Route::controller(RoleController::class)->group(function(){
        Route::get('/admin/roles', 'roles')->name('roles');
        Route::get('/admin/role/add', 'addrole')->name('role.add');
        Route::post('/admin/role/save', 'saverole')->name('role.save');
        Route::get('/admin/role/edit/{id}', 'editrole')->name('role.edit');
        Route::put('/admin/role/update/{id}', 'updaterole')->name('role.update');
        Route::get('/admin/role/delete/{id}', 'deleterole')->name('role.delete');
    });

    //Roles in Permission Route
    Route::controller(RoleController::class)->group(function(){
        Route::get('/admin/roles/permissions', 'rolespermissions')->name('rolespermissions');
        Route::get('/admin/rolepermission/add', 'rolepermissionadd')->name('rolepermission.add');
        Route::post('/admin/rolepermission/save', 'rolepermissionsave')->name('rolepermission.save');
        Route::get('/admin/rolepermission/edit/{id}', 'rolepermissionedit')->name('rolepermission.edit');
        Route::put('/admin/rolepermission/update/{id}', 'rolepermissionupdate')->name('rolepermission.update');
        Route::get('/admin/rolepermission/delete/{id}', 'rolepermissiondelete')->name('rolepermission.delete');
    });

    //Admin User Route
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/adminusers', 'adminusers')->name('adminusers');
        Route::get('/admin/adminuser/add', 'addadmin')->name('adminuser.add');
        Route::post('/admin/adminuser/save', 'saveadminuser')->name('adminuser.save');
        Route::get('/admin/adminuser/edit/{id}', 'editadminuser')->name('adminuser.edit');
        Route::put('/admin/adminuser/update/{id}', 'updateadminuser')->name('adminuser.upd');
        Route::get('/admin/adminuser/delete/{id}', 'deleteadminuser')->name('adminuser.delete');

    //database backup
        Route::get('/admin/database/backup', 'databasebackup')->name('database.backup');
        Route::get('/admin/database/backup/now', 'databasebackupnow')->name('database.backup.now');
        Route::get('/admin/backup/delete/{getFilename}', 'databasedelete')->name('database.backup.delete');
        Route::get('/admin/backup/download/{getFilename}', 'databasedownload')->name('database.backup.download');
 
    });
});


require __DIR__.'/auth.php';
