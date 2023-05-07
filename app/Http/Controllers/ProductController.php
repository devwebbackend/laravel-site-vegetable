<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
  {
    $products=Product::with('category')->orderBy('id','desc')->paginate(5);
   return  view('dashboard.product',compact('products'));
  }
  public function create(Request $request)
  { $categories=Category::all();
    return  view('dashboard.addproduct',compact('categories'));
  }
   public function store(ProductRequest $request)
  {
    $validated = $request->validated();
   // Product::create($validate);
   $product = new Product();
   $product->product=$request->product;
    $product->price=$request->price;
     $product->category_id=$request->category_id;
   
     if($request->hasFile('image'))
    {/* get file name with extention*/
    /*   $filenamewithex=$request->file('image')->getClientOriginaleName();*/
     /* get file name only*/
     
    /*  $fileName= pathinfo( $filenamewithex.'PATHINFO_FILENAME'); */
      /* get extention */
      
    /*  $extention= $request->file('image')->getClientOriginaleExtention(); */
     /* get file stored */
    /*  $fileNameStor=$fileName."_".time().".".$extention; */

    /* $path=$request->file('image')->storeAs('public/images',$fileNameStor); */
    $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/images' ;
            $file->move($destinationPath,$fileName);
            $product->image=$fileName."".time();
    }
    else
    {
      $fileName='noimage.jpg';

       // $path = storeAs('public/images',  $fileNameStor);
    }
  $product->image= $fileName;
     
     $product->save();
 return  redirect()->back()->with('succes','saved successefully');
  }
   public function update(ProductRequest $request)
  {$validated = $request->validated();
   // Product::update($request->all());
     $product->product=$request->product;
    $product->price=$request->price;
     $product->category_id=$request->category_id;
     $product->status=$request->status;
     $product->save();
 return  redirect()->back()->with('succes','saved successefully');
  }
 
  public function edit($id)
  {
     $product=Product::findOrFail($id);
  // return  redirect()->route('products.edit',compact('product',$product));
    return  view('dashboard.editproduct',compact('product'));
  }
   public function destroy($id)
  {
  /*   $product=Product::findOrFail($id);
     $product->delete();  */
     Product::destroy($id);
    return  redirect()->back()->with('succes','deleted successefully');
  }
  public function activeProduct($id)
 {
   $product=Product::findOrFail($id);
   $product->status= 0;
   $product->update();
   return redirect()->back();
 }
 public function unactiveProduct($id)
 {
   $product=Product::findOrFail($id);
   $product->status= 1;
   $product->update();
   return redirect()->back();
 }
}
