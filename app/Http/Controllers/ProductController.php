<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Buy;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;


class ProductController extends Controller
   // LABACT2

{
    // public $products = [
    //     ['id' => '1', 'name' => 'Nike Gloves', 'type' => 'Baseball Gloves', 'picture' => 'storage/img/nikeglove.jpg', 'price' => '$50', 'description' => 'High-quality baseball gloves for improved grip and protection.'],
    //     ['id' => '2', 'name' => 'Adidas Bat', 'type' => 'Baseball Bat', 'picture' => 'storage/img/adidasbat.jpg', 'price' => '$60', 'description' => 'Durable and lightweight baseball bat for better swing and performance.'],
    //     ['id' => '3', 'name' => 'Rawlings Helmet', 'type' => 'Baseball Helmet', 'picture' => 'storage/img/rawhelmet.jpg', 'price' => '$70', 'description' => 'Comfortable helmet with excellent protection and ventilation.'],
    //     ['id' => '4', 'name' => 'Easton Shin Guard', 'type' => 'Shin Guard', 'picture' => 'storage/img/eastshin.jpg', 'price' => '$80', 'description' => 'Protective shin guards designed for maximum comfort and safety.'],
    //     ['id' => '5', 'name' => 'Wilson Ball', 'type' => 'Baseball', 'picture' => 'storage/img/wilsonball.jpg', 'price' => '$90', 'description' => 'Official league baseball with superior durability and performance.'],
    //     ['id' => '6', 'name' => 'Mizuno Cleats', 'type' => 'Baseball Cleats', 'picture' => 'storage/img/mizuno_cleats.jpg', 'price' => '$30', 'description' => 'Comfortable and durable cleats with excellent traction for all field conditions.'],
    //     ['id' => '7', 'name' => 'Louisville Slugger Bat', 'type' => 'Baseball Bat', 'picture' => 'storage/img/louisville_slugger.jpg', 'price' => '$40', 'description' => 'Legendary bat known for its power and precision.'],
    //     ['id' => '8', 'name' => 'Under Armour Batting Gloves', 'type' => 'Batting Gloves', 'picture' => 'storage/img/under_armour_gloves.jpg', 'price' => '$50', 'description' => 'High-performance gloves for better grip and control at the plate.'],
    //     ['id' => '9', 'name' => 'Rawlings Catcher Mask', 'type' => 'Catcher’s Mask', 'picture' => 'storage/img/rawlings_mask.jpg', 'price' => '$60', 'description' => 'Lightweight and durable mask with excellent protection for catchers.'],
    //     ['id' => '10', 'name' => 'Easton Baseball Bag', 'type' => 'Baseball Bag', 'picture' => 'storage/img/easton_bag.jpg', 'price' => '$70', 'description' => 'Spacious baseball bag with multiple compartments for all your gear.'],
    // ];
    

    

    
    // GUEST
    public function shop(){
        $products = Product::all();
        return view('guest.shop', compact('products'));
    }

    // AUTHENTICATED

    public function usershop(){
        $products = Product::all();
        return view('user.user-shop', compact('products'));
    }
    public function usershopreserve()
    {
        $buys = Buy::where('user_id', Auth::id())
                    ->latest()
                    ->withTrashed()
                    ->paginate(5);
    
        return view('user.user-shopreserve', compact('buys'));
    }
    
    public function mshop(){
        $buys = Buy::latest()->paginate(5);
        $products = Product::withTrashed()->latest()->paginate(5);
        return view('admin.manage-shop', compact('products', 'buys'));
    
    }
   
    public function addproduct(){
        return view('admin.add-product');
    }
   
    public function editproduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            return view('admin.edit-product', ['product' => $product]); 
        } else {
            abort(404, 'Product not found.'); 
        }
    }
    
    public function userbuy($id)
    {
        $product = Product::find($id);
        if ($product) {
            return view('user.user-buy', ['product' => $product]); 
        } else {
            abort(404, 'Product not found.'); 
        }
    }
    public function post(string $slug) {
   
    $lowercase = strtolower($slug);
    $withSpace = str_replace('-', ' ', $lowercase);
    $productName = ucwords($withSpace);
    $product = collect($this->products)->firstWhere('name', $productName);

    if ($product) {
       
        return view('user.product-post', compact('product'));
    } else {
       
        abort(404);
    }
}


// Create

public function storeproduct(Request $request){
   $validated = $request->validate([
    'photo' => 'required|unique:products|mimes:jpg,jpeg,png',
    'name'=>'required|unique:products|max:100',
    'type'=>'required|max:50',
    'description'=>'required|min:20',
    'price'=>'required|numeric|min:0.01',
   ],[
        'photo.required' => 'Please add a photo of the product',
        'photo.unique' => 'Product photo already exists',
        'photo.mimes' => 'Product photo must be in jpg,jpeg or png format',
        'name.required' => 'Please add the name of the product',
        'name.unique' => 'Product is already existing',
        'name.max' => 'The name must not exceed 100 characters',
        'type.required' => 'Please add the type of the product',
        'type.max' => 'The type must not exceed 50 characters',
        'description.required' => 'Please add description of the product',
        'description.min' => 'Invalid, Please add more details of the product',
        'price.required' => 'Please add the price of the product',
        'price.numeric' => 'The price must be a valid number',
        'price.min' => 'The price must be greater than $0',
   ]);

   $photo = $request->file('photo');
   $name_gen = hexdec(uniqid()).'.'.
   $photo->getClientOriginalExtension();
   $photo->move('photo/products/', $name_gen);
   $pic=Image::read('photo/products/'.$name_gen)->resize(200,200)->save();

    $last_photo = 'photo/products/'.$name_gen;

   
    Product::insert([
        'photo' =>  $last_photo,  
        'name' => $request->name,
        'type' => $request->type,
        'description' => $request->description,
        'price' => $request->price,
        'user_id' => Auth::user()->id,
        'created_at' => Carbon::now(),
    ]);

    return Redirect()->route('manage-shop')->with('success', 'Product added successfully!');
}

public function storesbuy(Request $request){
    $validated = $request->validate([
        'fullname' => 'required|string|max:100',
        'address' => 'required|min:10',
        'number' => 'required|numeric|digits_between:8,15',
        'quantity' => 'required|integer|min:1',
    ], [
        'fullname.required' => 'Please add your full name',
        'fullname.string' => 'The full name must contain valid characters',
        'fullname.max' => 'The full name must not exceed 100 characters',
        'address.required' => 'Please add your address',
        'address.min' => 'The address must be at least 10 characters long',
        'number.required' => 'Please add your contact number',
        'number.numeric' => 'The contact number must be a valid number',
        'number.digits_between' => 'The contact number must be between 8 and 15 digits',
        'quantity.required' => 'Please indicate the quantity of the product',
        'quantity.integer' => 'The quantity must be a whole number',
        'quantity.min' => 'The quantity must be at least 1',
    ]);
 
    Buy::insert([
    'productid' =>$request->productid,
     'fullname' => $request->fullname,
     'address' => $request->address,
     'number' => $request->number,
     'quantity' => $request->quantity,
     'user_id' => Auth::user()->id,
     'created_at' => Carbon::now()
    ]);
 
    return Redirect()->route('user-shop')->with('success', 'Product purchased successfully!');
 
 }

public function updateproduct(Request $request, $id) {
    $validated = $request->validate([
        'photo' => 'nullable|mimes:png,jpg,jpeg|unique:products',
        'name' => 'required|max:100' ,
        'type' => 'required|max:50',
        'description' => 'required|min:20',
        'price' => 'required|numeric|min:0.01',
    ], [
        
        'photo.unique' => 'Product photo already exists',
        'photo.mimes' => 'Product photo must be in jpg,jpeg or png format',
        'name.required' => 'Please add the name of the product',
        'name.max' => 'The name must not exceed 100 characters',
        'type.required' => 'Please add the type of the product',
        'type.max' => 'The type must not exceed 50 characters',
        'description.required' => 'Please add a description of the product',
        'description.min' => 'Invalid, Please add more details of the product',
        'price.required' => 'Please add the price of the product',
        'price.numeric' => 'The price must be a valid number',
        'price.min' => 'The price must be greater than $0',
    ]);

   
    $product = Product::find($id);
    
    
   
   if ($request->hasFile('photo')) {
    
    if (file_exists(public_path($product->photo))) {
        unlink(public_path($product->photo)); 
    }
    $photo = $request->file('photo');
    $name_gen = hexdec(uniqid()) . '.' . $photo->getClientOriginalExtension();
    $photo->move('photo/products/', $name_gen);
    
    $pic = Image::read('photo/products/' . $name_gen)->resize(200, 200)->save();
    $last_photo = 'photo/products/'.$name_gen;
    $product->photo = $last_photo; 
}

 
    $product->name = $request->name;
    $product->type = $request->type;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->updated_at = Carbon::now(); 
    $product->save(); 

    return redirect()->route('manage-shop')->with('updated', 'Product updated successfully!');
}
 // Soft delete a product
 public function destroy($id)
 {
     $deleted = Product::where('id', $id)->delete();

     if ($deleted) {
         return redirect()->route('manage-shop')->with('successsoft', 'Product deleted successfully.');
     } else {
         return abort(404, 'Game not found.');
     }
 }

 // Restore a soft-deleted product
 public function restore($id)
 {
     $product = Product::withTrashed()->find($id);

     if ($product) {
         $product->restore();
         return redirect()->route('manage-shop')->with('successrestore', 'Product restored successfully.');
     } else {
         return abort(404, 'Game not found.');
     }
 }

 
 public function forceDelete($id) {
    $product = Product::withTrashed()->find($id);

    if ($product) {
        // Delete the image from storage if it exists
        if (file_exists(public_path($product->photo))) {
            unlink(public_path($product->photo)); // Deletes the image file
        }

        // Permanently delete the product from the database
        $product->forceDelete();
        
        return redirect()->route('manage-shop')->with('successdelete', 'Product permanently deleted.');
    } else {
        return abort(404, 'Product not found.');
    }
}


    
    
}