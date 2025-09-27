<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ProductsExport;
use App\Helpers\CodeGenerator;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Services\QRCodeGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorSVG;

class ProductController extends Controller
{
    //Products routes
    public function products()
    {
        $compteur = 1;
        $products =  Product::latest()->get();
        return view('admin.products.products', compact('products', 'compteur'));
    }

    //generate code
    function generateAlphaNumericCode(string $prefix = 'PR', int $length = 8): string {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomLength = max(0, $length - strlen($prefix));
        $random = '';

        for ($i = 0; $i < $randomLength; $i++) {
            $random .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $prefix . $random;
    }


    public function add()
    {
        // Code to show the form for creating a new product
        $suppliers = Supplier::latest()->get();
        $categories = Category::latest()->get();
        $code = CodeGenerator::generateUniqueProductCode('PC', 12);
        return view('admin.products.add', compact('suppliers', 'categories', 'code'));
    }

    public function save(Request $request)
    {
            // Code to store the product
        $product = new Product();
        $product->supplier_id = $request->supplier_id;
        $product->category_id = $request->category_id;
        $product->product_code = $request->product_code;
        $product->product_name = $request->product_name;
        $product->product_garage = $request->product_garage;
        $product->product_store = $request->product_store;
        $product->buying_date = $request->buying_date;
        $product->expire_date = $request->expire_date;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        //image upload
        if ($request->file('product_image')) {
            # code...
            $this->validate(
                $request,
                [
                    'product_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                ],
                [
                    'product_image.image' => 'La photo du produit doit être une image',
                    'product_image.mimes' => 'La photo du produit doit être un fichier de type : jpeg, png, jpg, webp',
                    'product_image.max' => 'La photo du produit ne doit pas dépasser 2 Mo',
                ]
            );
            // 📥 Récupération du fichier
            $productImage = $request->file('product_image');

            // 📛 Nom original et extension
            $originalName = $productImage->getClientOriginalName();
            $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $productImage->getClientOriginalExtension();

            // 🆕 Nom unique
            $productImageName = $request->product_code .'.' . $extension;

            // 📁 Dossier cible
            $destinationPath = public_path('backend/images/products');

            // 📂 Création du dossier si nécessaire
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // 🗑️ Suppression de l’ancienne image
            $oldImagePath = $destinationPath . '/' . $product->product_image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // 📤 Déplacement du nouveau fichier
            $productImage->move($destinationPath, $productImageName);

            // 🖊️ Mise à jour du modèle
            $product->product_image = $productImageName;
        }

        $product->save();
        $notification = array(
            'message' => 'Produit ajouté avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('products')->with($notification);
    }

    public function show($id)
    {
        // Code to display a single product
        $product = Product::findOrFail($id);
        // Generate QR code for the product
        $qrcode = (new QRCodeGeneratorService())->generate($product->product_code);

        return view('admin.products.show', compact('product', 'qrcode'));
    }

    public function edit($id)
    {
        // Code to show the form for editing a product
        $suppliers = Supplier::latest()->get();
        $categories = Category::latest()->get();
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product', 'suppliers', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Code to update a product
        $product = Product::findOrFail($id);
        $product->supplier_id = $request->supplier_id;
        $product->category_id = $request->category_id;
        $product->product_code = $request->product_code;
        $product->product_name = $request->product_name;
        $product->product_garage = $request->product_garage;
        $product->product_store = $request->product_store;
        $product->buying_date = $request->buying_date;
        $product->expire_date = $request->expire_date;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        //image upload
        if ($request->file('product_image')) {
            # code...
            $this->validate(
                $request,
                [
                    'product_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                ],
                [
                    'product_image.image' => 'La photo du produit doit être une image',
                    'product_image.mimes' => 'La photo du produit doit être un fichier de type : jpeg, png, jpg, webp',
                    'product_image.max' => 'La photo du produit ne doit pas dépasser 2 Mo',
                ]
            );
            // 📥 Récupération du fichier
            $productImage = $request->file('product_image');

            // 📛 Nom original et extension
            $originalName = $productImage->getClientOriginalName();
            $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $productImage->getClientOriginalExtension();

            // 🆕 Nom unique
            $productImageName = $request->product_code . '.' . $extension;

            // 📁 Dossier cible
            $destinationPath = public_path('backend/images/products');

            // 📂 Création du dossier si nécessaire
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // 🗑️ Suppression de l’ancienne image
            $oldImagePath = $destinationPath . '/' . $product->product_image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // 📤 Déplacement du nouveau fichier
            $productImage->move($destinationPath, $productImageName);

            // 🖊️ Mise à jour du modèle
            $product->product_image = $productImageName;
        }

        $product->update();
        $notification = array(
            'message' => 'Produit mis à jour avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('products')->with($notification);

    }

    public function delete($id)
    {
        // Code to delete a product
        $product = Product::findOrFail($id);
        // Supprimer la photo du produit
        $oldImagePath = public_path('backend/images/products/' . $product->product_image);
        if (File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        }
        $product->delete();
        $notification = array(
            'message' => 'Produit supprimé avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('products')->with($notification);
    }
    //Import Products
    public function import()
    {
        return view('admin.products.import');
    }

    // Export Products
    public function export()
    {
        // Export products to Excel
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    // Import Products
    public function imported(Request $request)
    {

        if ($request->file('import_file')) {
            # code...
                    $request->validate([
            'import_file' => 'required|mimes:xlsx,csv'
        ], [
            'import_file.required' => 'Veuillez sélectionner un fichier à importer',
            'import_file.mimes' => 'Le fichier doit être de type : xlsx, csv'
        ]);
        Excel::import(new ProductsImport, $request->file('import_file'));
        $notification = array(
            'message' => 'Produits importés avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('products')->with($notification);
        }else {
            $notification = array(
                'message' => 'Aucun fichier sélectionné',
                'alert-type' => 'error'
            );
            return redirect()->route('products')->with($notification);
        }

    }

}
