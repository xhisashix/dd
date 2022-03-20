<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * postテーブルからすべてのデータを取得
     * @return \Illuminate\Http\Response
     */
    public function getPostData() {
        $posts = DB::table('posts')->get();

        return $posts;
    }

    /**
     * postテーブルから指定したidのデータを取得
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPostDataById($id) {
        $posts = DB::table('posts')->where('id', $id)->get();

        return $posts;
    }

    /**
     * postテーブルにデータを追加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPostData(Request $request) {
        $posts = new Posts;
        $posts->user_id = $request->user_id;
        $posts->title = $request->title;
        $posts->content = $request->content;
        $posts->status = $request->status;
        $posts->tags = $request->tags;
        $posts->save();

        return $request;
    }
}