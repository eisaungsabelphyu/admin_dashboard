<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //category list page
    public function list(){
        $categories = Category::orderBy('id','desc')->paginate('3');
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    //create page
    public function create(){
        return view('admin.category.create');
    }

    //store category
    public function store(Request $request){
        Validator::make($request->all(),[
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg'
        ])->validate();

        $data = [
            'name' => $request->name,
            'publish' => $request->status  ? '1' : '0'
        ];

        $category = Category::create($data);

        $fileName = uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);

        $category->image()->create([
                'name' => $fileName,
                 'imageable_id' => $category->id,
                 'imageable_type' => Category::class,
            ]);
        return redirect()->route('admin#categoryList')->with(['message' => 'Category Added Successfully!']);
    }

    //edit page
    public function edit(Category $category){

        $image = $category->image->name;
        return view('admin.category.edit',compact('category','image'));
    }

    //update category
    public function update(Request $request,$category_id){

        Validator::make($request->all(),[
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg'
        ])->validate();

        $data = [
            'name' => $request->name,
            'publish' => $request->status  ? '1' : '0'
        ];
      

        if($request->hasFile('image')){
            $category = Category::find($category_id);
            $dbImage = $category->image->name;
            Storage::delete('public/'.$dbImage);

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
        }
        $category->image()->update([
                    'name' => $fileName,
                ]);
         Category::where('id',$category_id)->update($data);

        return redirect()->route('admin#categoryList')->with(['message' => 'Category Updated Successfully!']);
    }

    //delete category
    public function delete(Category $category){
        $localImg = $category->image->name;
        Storage::delete('public/'.$localImg);

        $category->image->delete();
        $category->delete();
        return redirect()->route('admin#categoryList')->with(['message'=>'Deleted']);
    }

}
