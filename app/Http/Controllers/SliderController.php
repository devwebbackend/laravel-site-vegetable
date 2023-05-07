<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;

class SliderController extends Controller
{
   public function index(Request $request)
  {
   $sliders=  Slider::orderBy('id','desc')->get();
     return view('dashboard.slider',compact('sliders'));
  }
  public function create(Request $request)
  {
   return   view('dashboard.addslider');
  }
  public function store(SliderRequest $request)
  {
     $slider= new Slider();
    $validate= $request->validated();
     if($request->hasFile('image'))
   {
      $file=$request->file('image');
       $nameFile=$file->getClientOriginalName();
   // $ext=$nameFile->getClientOriginalExtention();
    $filestore= time()."".$nameFile;
     $file->move(public_path()."/images",$filestore);
   $slider->image=$filestore;
   }
   
     else
     {
       $slider->image="noimage.jpg";
      
     }
$slider->description=$request->description;
$slider->description2=$request->description2;
$slider->status =1;
$slider->save();
  // $slider=Slider::create($request->all());

   return   redirect()->back()->with('succes','slider added successfully');
  }
  public function edit($id)
  {
    $slider=Slider::findOrFail($id);

   return   view('dashboard.editslider','slider');
  }


  public function destroy($id)
  {
   $slider=Slider::findOrFail($id);

   return  redirect()->back()->with('succes','deleted successfully');
  }
public function activeSlider($id)
{
    $slider=Slider::findOrFail($id);
    $slider->status=1;
    $slider->update();
return redirect()->back();
}
public function unactiveSlider($id)
{
    $slider=Slider::findOrFail($id);
    $slider->status=0;
    $slider->update();
return redirect()->back();
}

}

