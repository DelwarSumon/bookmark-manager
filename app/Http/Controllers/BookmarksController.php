<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BookmarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bookmarkList()
    {
        $table = "bookmarks";
        return response(
            [
                'message' => "Got It",
                'data' => Schema::getColumnListing("bookmarks"),
                'data2' => DB::getSchemaBuilder()->getColumnListing($table)
            ], 200
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bookmarkListByFolder()
    {
        //
        // echo "Got it";
        $table = "bookmarks";
        return response(
            [
                'message' => "Got It",
                'data' => Schema::getColumnListing("bookmarks"),
                'data2' => DB::getSchemaBuilder()->getColumnListing($table)
            ], 200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request 
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request 
     * @param \App\Models\Bookmark     $bookmark 
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bookmark $bookmark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Bookmark $bookmark 
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookmark $bookmark)
    {
        //
    }
}
