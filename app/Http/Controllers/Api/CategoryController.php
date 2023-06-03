<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //get all categories
    public function index(){
        $categories = Category::get();
        return response()->json([
            'status' => 'success',
            'categories' => $categories
        ], 200);
    }
}
