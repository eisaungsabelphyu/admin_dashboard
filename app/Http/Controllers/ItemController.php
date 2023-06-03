<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    //direct item list page
    public function list(){
        $items = Item::select('items.*','categories.name as category')
                ->leftJoin('categories','items.category_id','categories.id')
                ->orderBy('items.id','desc')->paginate(3);
        $items->appends(request()->all());
        return view('admin.item.itemList',compact('items'));
    }

    //add item page
    public function create(){
        $categories = Category::get();
        return view('admin.item.createPage',compact('categories'));
    }

    //save item
    public function store(Request $request){
        $this->requestValidationCheck($request,'store');
        $data = $this->requestItemInfo($request);

        $fileName = uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);

        $item = Item::create($data);

        $item->image()->create([
            'name' => $fileName,
            'imageable_id' => $item->id,
            'imageable_type' => Item::class
        ]);
        return redirect()->route('admin#itemList');

    }

    //edit page
    public function edit($id){
        $categories = Category::get();
        $item = Item::select('items.*','categories.name as category')
                    ->leftJoin('categories','items.category_id','categories.id')
                    ->where('items.id',$id)->first();       
        return view('admin.item.edit',compact('item','categories'));
    }

    //update
    public function update(Request $request,$id){
        $this->requestValidationCheck($request,'update');
        $data = $this->requestItemInfo($request); 

        if($request->hasFile('image')){
            $item = Item::find($id);
            $dbImage = $item->image->name;
            Storage::delete('public/'.$dbImage);
            
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
        }
        $item->image()->update([
                'name' => $fileName
            ]);
        Item::where('id',$id)->update($data);
        return redirect()->route('admin#itemList')->with(['message' => 'Updated Successfully']);
    }

    //delete item
    public function delete(Item $item){

        $localImg = $item->image->name;
        Storage::delete('public/'.$localImg); 

        $item->image->delete();
        $item->delete();
        return redirect()->route('admin#itemList')->with(['message' => 'Deleted Successfully']);
    }

    //request item
    private function requestItemInfo($request){
        return [
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'condition' => $request->condition,
            'status' => $request->status ? '1' : '0',
            'owner_name' => $request->ownerName,
            'phone' => $request->phone,
            'address' => $request->address,
            'lat_long' => $request->latLng
        ];
    }

    //check validation
    private function requestValidationCheck($request,$action){
        $validationRules = [
            'name' => 'required|min:3',
            'category' => 'required',
            'price' => 'required',
            'description' => 'required',
            'ownerName' => 'required|min:3',
            'phone' => 'nullable|min:10',
            'address' => 'nullable|string',
            'latLng' => 'nullable|string',
        ];
        $validationRules['image'] = $action == 'update' ? 'mimes:jpg,png,jpeg' : 'required|mimes:jpg,png,jpeg';
        Validator::make($request->all(),$validationRules)->validate();
    }
}
