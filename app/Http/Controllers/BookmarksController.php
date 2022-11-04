<?php
/**
 * PHP version 8.1.6
 * 
 * @category Category
 * @package  Package
 * @author   Delwar Sumon <delwarsumon0@gmail.com>
 * @license  MIT http://url.com
 * @link     http://url.com
 */
namespace App\Http\Controllers;

use App\Models\Bookmark;
use Exception;
use Illuminate\Http\Request;

/**
 * Bookmarks related methods
 * 
 * @category Category
 * @package  Package
 * @author   Delwar Sumon <delwarsumon0@gmail.com>
 * @license  MIT http://url.com
 * @link     http://url.com
 */
class BookmarksController extends Controller
{
    /**
     * Display a listing of the bookmark.
     * 
     * @param \Illuminate\Http\Request $request 
     * @param \App\Models\Bookmark     $bookmark is object of Bookmark model
     * 
     * @return \Illuminate\Http\Response
     */
    public function bookmarkList(Request $request, Bookmark $bookmark)
    {
        try{
            $data = $bookmark->getList($request);
            return response(
                $data, 200
            );
        } catch(Exception $e) {
            return response(
                [
                    'message' => $e->getMessage()
                ], 400
            );
        }
    }

    /**
     * Display a listing of the bookmark by folder id.
     * 
     * @param \Illuminate\Http\Request $request 
     * @param \App\Models\Bookmark     $bookmark  is object of Bookmark model
     * @param int                      $folder_id folder id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function bookmarkListByFolder(
        Request $request, Bookmark $bookmark, int $folder_id
    ) {
        try{
            $data = $bookmark->getListByFolder($folder_id, $request);
            return response(
                $data, 200
            );
        } catch(Exception $e) {
            return response(
                [
                    'message' => $e->getMessage()
                ], 400
            );
        }
    }

    /**
     * Store a newly created bookmark in storage.
     *
     * @param \Illuminate\Http\Request $request 
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->validate(
                $request, 
                [
                    'name' => 'required|string|min:3|max:255', 
                    'url' => 'required|url',
                    'folder_id' => 'nullable|integer'
                ]
            );

            //To create record in DB with all data from request. 
            // You have to ensure all the request attribute is exists in DB Table 
            // $bookmark = new Bookmark();
            // $bookmark->insert($request->all()); 

            //To create record in DB with all data from request 
            // but except _method, _token attribute. 
            // Bookmark::create($request->except(["_method", "_token"]));
            
            //To create record in DB with specified data from request 
            // Bookmark::create(
            //     [
            //         "name" => $request->name, 
            //         "url" => $request->url, 
            //         "folder_id" => $request->folder_id
            //     ]
            // );
            // OR
            Bookmark::create($request->only(["name", "url", "folder_id"]));

            return response(
                [
                    'message' => "Data stored successfully.",
                ], 200
            );
        } catch(\Illuminate\Database\QueryException $ex) { 
            return response(
                [
                    'message' => $ex->getMessage()
                ], 400
            );
        } catch(Exception $e) {
            return response(
                [
                    'message' => $e->getMessage()
                ], 400
            );
        }
    }

    /**
     * Update the specified bookmark in storage.
     *
     * @param \Illuminate\Http\Request $request 
     * @param int                      $id      bookmark id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        try{
            $this->validate(
                $request, 
                [
                    'name' => 'string|min:3|max:255', 
                    'url' => 'url',
                    'folder_id' => 'nullable|integer'
                ]
            );
            
            // Find record in DB by id
            $bookmark = Bookmark::find($id);
            if ($bookmark) { //If true (means exists)
                // Update "name", "url", "folder_id" column of a record in DB
                $bookmark->update($request->only(["name", "url", "folder_id"]));
            }

            return response(
                [
                    'message' => ($bookmark) ? "Data updated successfully." : 
                        "Id is invalid"
                ], 200
            );

        } catch(\Illuminate\Database\QueryException $ex) { 
            return response(
                [
                    'message' => $ex->getMessage()
                ], 400
            );
        } catch(Exception $e) {
            return response(
                [
                    'message' => $e->getMessage()
                ], 400
            );
        }
    }

    /**
     * Remove the specified bookmark from storage.
     *
     * @param int $id bookmark id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try{
            
            // Delete a specific record from DB if id is matched
            // Bookmark::where("id", $id)->delete();

            // Find record in DB by id
            $bookmark = Bookmark::find($id);
            if ($bookmark) { //If true (means exists)
                // Delete the record from DB
                $bookmark->delete();
            }

            return response(
                [
                    'message' => ($bookmark) ? "Data deleted successfully." : 
                        "Id is invalid"
                ], 200
            );

        } catch(\Illuminate\Database\QueryException $ex) { 
            return response(
                [
                    'message' => $ex->getMessage()
                ], 400
            );
        } catch(Exception $e) {
            return response(
                [
                    'message' => $e->getMessage()
                ], 400
            );
        }
    }
}
