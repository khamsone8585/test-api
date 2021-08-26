<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = DB::table('blogs')->get();
        return response()->json($blogs, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blogs = DB::table('blogs')->insert([
            'title' => $request->title,
            'content' => $request->content,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return response()->json($blogs, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogs = DB::table('blogs')->where('id', $id)->get();
        if ($blogs == null) {
            return response()->json([
               'errors' => [
                 'status_code' => 404,
                 'message' => 'ບໍ່ພົບຂໍ້ມູນນີ້'
               ]
            ], 404);//http status code
        }
        return response()->json($blogs, 200);
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
        $blogs = DB::table('blogs')->where('id', $request->id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return response()->json($blogs, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blogs = DB::table('blogs')->where('id',  $request->$id)->delete();
        return response()->json($blogs, 200);
    }
}
