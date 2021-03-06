<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $posts = DB::table('posts')->leftJoin('categories', 'posts.categories_id', '=', 'categories.id')->get();

        return $posts;
    }


    /**
     * postテーブルからstatusが０のものだけを取得
     * @return \Illuminate\Http\Response
     */
    public function getPostDataByStatus($status)
    {
        $posts = new Posts;

        $post = $posts
            ->join('categories', 'posts.categories_id', '=', 'categories.id')
            ->select('posts.id', 'posts.title', 'categories.name')
            ->get();

        return response()->json([
            'response_code' => '200',
            'message' => '公開の記事を取得しました。',
            'data' => $post,
        ]);
    }

    /**
     * postテーブルから指定したidのデータを取得
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPostDataById($id)
    {
        $posts = new Posts;

        //カテゴリの情報も一緒に取得
        $post = $posts->find($id)->load('category');

        return response()->json([
            [
                'response_code' => '200',
                'message' => '記事の取得に成功しました。',
                'data' => $post
            ]
        ]);
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
        $posts->categories_id = $request->categories_id;
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
                'categories_id' => $request->categories_id
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
    public function getPostDataByUserId($user_id)
    {
        $posts = DB::table('posts')->where('user_id', $user_id)->get();
        return $posts;
    }

    /**
     * 投稿のサムネイル画像をアップロード
     */
    public function uploadThumbnail(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $path = $request->file('file')->storeAs('/images/thumbnail', $filename);

        // アップロードに成功した場合DBへ保存
        $posts = new Posts;
        $post = $posts->find($request->id);
        $post->thumbnail = $path;
        $post->save();

        return response()->json([
            'response_code' => '200',
            'message' => 'サムネイル画像をアップロードしました。',
            'data' => [
                $path,
            ]
        ]);
    }
}
