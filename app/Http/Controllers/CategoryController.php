<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Helper;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return response()->json([
            'status' => '200',
            'data' => $categories,
            'message' => 'Success'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string'
        ]);

        $category = $this->saveCategory($request);

        return response()->json([
            'status' => '201',
            'data' => $category,
            'message' => 'Success'
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeLeaf(Request $request, $parent_id)
    {
        $request->validate([
            'category_name' => 'required|string'
        ]);

        $parent_category = Category::find($parent_id);
        if (empty($parent_category)) {
            return response()->json([
                'status' => '400',
                'message' => 'Bad Request'
            ], 400);
        }

        $category = $this->saveCategory($request);

        return response()->json([
            'status' => '201',
            'data' => $category,
            'message' => 'Success'
        ], 201);
    }

    private function saveCategory($request) {
        $uniqid = Helper::autoIncrementCategory();
        $category = new Category([
            'category_name' => $request->category_name,
            'category_id' => $uniqid,
            'parent_id' => $request->parent_id
        ]);
        $category->save();
        return $category;
    }
    /**
     * Display the specified resource tree.
     */
    public function show($id)
    {
        $categories = Category::find($id);
        return response()->json([
            'status' => '200',
            'data' => $categories,
            'message' => 'Success'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function showTree($id)
    {
        $category = Category::select('category_id', 'category_name', 'parent_id')->where('category_id', $id)->get()->toArray();
        $categories = Category::select('category_id', 'category_name', 'parent_id')->get()->toArray();
        if (1) {
            $dic = [];
            foreach ($categories as $key => $cate) {
                $dic[$cate['parent_id']][] = $cate;
            }
            $category_tree = $this->setTree($category, $dic);
        }
        header('Content-Type: application/json; charset=utf-8', true);
        return json_encode([
            'status' => '200',
            'data' => $category_tree,
            'message' => 'Success'
        ], JSON_THROW_ON_ERROR, 100000);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categories = Category::where('category_id', $id)->delete();
        return response()->json([
            'status' => '200',
            'message' => 'Success'
        ], 200);
    }

    function setTree($category, $dic) {
        foreach ($category as $key => $root) {
            if (!empty($dic[$root['category_id']])) {
                $category[$key]['child'] = $this->setTree($dic[$root['category_id']], $dic);
            }
        }
        return $category;
    }
}
