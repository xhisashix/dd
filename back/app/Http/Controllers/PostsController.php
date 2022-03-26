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
    public function getPostData()
    {
        $posts = DB::table('posts')->get();

        return $posts;
    }


    /**
     * postテーブルからstatusが０のものだけを取得
     * @return \Illuminate\Http\Response
     */
    public function getPostDataByStatus($status)
    {
        $posts = DB::table('posts')->where('status', $status)->get();
        return $posts;
    }

    /**
     * postテーブルから指定したidのデータを取得
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPostDataById($id)
    {
        $posts = DB::table('posts')->where('id', $id)->get();

        return $posts;
    }

    /**
     * postテーブルにデータを追加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPostData(Request $request)
    {
        $posts = new Posts;

        // ユーザーIDがからのときエラーを返す
        if (empty($request->user_id)) {
            $message = "ユーザーIDは必須項目です。";
            return response()->json([
                'response_code' => '402',
                'message' => $message,
            ]);
        }

        // タイトルがからのときエラーを返す
        if (empty($request->title)) {
            $message = "タイトルは必須項目です。";
            return response()->json([
                'response_code' => '402',
                'message' => $message
            ]);
        }

        $posts->user_id = $request->user_id;
        $posts->title = $request->title;
        $posts->content = $request->content;
        $posts->status = $request->status;
        $posts->tags = $request->tags;
        $posts->save();

        return response()->json([
            [
                'response_code' => '200',
                'message' => '記事を作成しました。',
                'data' => $request
            ]
        ]);
    }

    /**
     * postテーブルから指定したidのデータを削除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePostDataById(Request $request)
    {
        $posts = DB::table('posts')->where('id', $request->id)->delete();

        return response()->json(
            [
                'response_code' => '200',
                'message' => '投稿を削除しました。',
                'data' => $posts
            ]
        );
    }

    /**
     * postテーブルから指定したidのデータを更新
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePostDataById(Request $request)
    {
        $posts = DB::table('posts')->where('id', $request->id)->update(
            [
                'id' => $request->id,
                'user_id' => $request->user_id,
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status,
                'tags' => $request->tags
            ]
        );

        return response()->json(
            [
                'response_code' => '200',
                'message' => '投稿を更新しました。',
                'data' => $posts
            ]
        );
    }

    /**
     * ユーザーIDに紐づくデータを取得
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function getPostDataByUserId($user_id) {
        $posts = DB::table('posts')->where('user_id', $user_id)->get();
        return $posts;
    }
}
