<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * categoriesテーブルにデータを追加する
     *
     * @return \Illuminate\Http\Response
     */
    public function addCategoryData(Request $request)
    {
        $request->only('category_name', 'user_id');

        // category_nameが空の場合は、json形式でエラーを返す
        if (empty($request->category_name)) {
            return response()->json([
                'error' => 'category_name is required.',
            ], 400);
        }
        $category = new Category;
        // categoriesテーブルに同じcategory_nameがあるかどうかを調べる
        $exist_category = $category->where('user_id', $request->user_id)->where('name', $request->category_name)->first();

        // 同じcategory_nameがある場合は、json形式でエラーを返す
        if ($exist_category) {
            return response()->json([
                'error' => 'category_name is already exist.',
            ], 400);
        }

        // テーブルにデータを追加する
        $category->user_id = $request->user_id;
        $category->name = $request->category_name;
        $category->save();

        return response()->json([
            [
                'response_code' => '200',
                'message' => 'カテゴリーの登録に成功しました。',
            ]
        ]);
    }

    /**
     * 指定したIDのデータを取得
     */
    public static function getCategory($id){

        $category = new Category;
        $get_category = $category->where('id', $id)->first();

        return $get_category;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        //
    }
}
