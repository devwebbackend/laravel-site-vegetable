<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategorieRequest;

class CategoryController extends Controller
{
  public function create()
  {
      return view("dashboard.addcategory");
  }
   public function store(CategorieRequest $request)
  {
 
      
    Category::create($request->all());
return redirect()->back()->with('succes','saved succefully');
     // return redirect(url('categories'))->with('succes','saved succefully');
  }
   public function update(CategorieRequest $request,$id)
  {    
      $category =Category::findOrFail($id);
    // $req = $request->validate();
      $category->update($request->all());
return redirect()->back()->with('succes','updated succefully');
      //return redirect(url('categories'))->with('succes','updated succefully');
  }
   public function edit($id)
  {    
      $category =Category::findOrFail($id);
     
//print($id);
      return view('dashboard.editcategory',compact('category'));
  }
   public function show($id)
  {
  $category=Category::findOrFail($id);
  
    return redirect()->route()->with('category',$category);
  }
  
  public function index(Request $request)
  {
   $categories=  Category::orderBy('id','desc')->paginate(5);
    return view("dashboard.categories",compact('categories'));
  }
  public function destroy($id)
  {
  $category=Category::findOrFail($id);
  $category->delete();
    return redirect()->back()->with('succes','deleted succefully');
  }


}
