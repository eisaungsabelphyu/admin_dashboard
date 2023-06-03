<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    //get all items
    public function index(){

        $items = Item::select('items.*','categories.name as category_name','images.name as image_url')
                    ->when(request('searchKey'),function($query){
                        $query->orWhere('items.name','like','%'.request('searchKey').'%');
                    })
                    ->when(request('categoryId'),function($q){
                        $q->where('items.category_id',request('categoryId'));
                    })
                    ->leftJoin('categories','items.category_id','categories.id')
                    ->leftJoin('images', function ($join) {
                            $join->on('items.id', '=', 'images.imageable_id')
                                ->where('images.imageable_type', '=', 'App\Models\Item');
                    })
                    ->distinct()
                    ->get();

        return response()->json([
            'status' => 'success',
            'items' => $items,

        ], 200);

    }

    //item detail
    public function detail(Request $request){
        $item = Item::select('items.*','categories.name as category','images.name as image_url')
                    ->leftJoin('categories','items.category_id','categories.id')
                     ->leftJoin('images', function ($join) {
                            $join->on('items.id', '=', 'images.imageable_id')
                                ->where('images.imageable_type', '=', 'App\Models\Item');
                    })
                    ->where('items.id',$request->itemId)
                    ->first();

        return response()->json([
            'status' => 'success',
            'item' => $item,

        ], 200);


    }
}
