<?php
/**
 * PHP version 8.1.6
 * 
 * @category Description
 * @package  Category
 * @author   Delwar Sumon <delwarsumon0@gmail.com>
 * @license  MIT http://url.com
 * @link     http://url.com
 */

namespace App\Http\Controllers;

use App\Models\Folder;
use Exception;
use Illuminate\Http\Request;

/**
 * Folder related methods
 * 
 * @category Description
 * @package  Category
 * @author   Delwar Sumon <delwarsumon0@gmail.com>
 * @license  MIT http://url.com
 * @link     http://url.com
 */
class FoldersController extends Controller
{
    /**
     * Display a listing of the folder.
     * 
     * @param \Illuminate\Http\Request $request 
     * @param \App\Models\Folder       $folder  is object of Folder model
     * 
     * @return \Illuminate\Http\Response
     */
    public function folderList(Request $request, Folder $folder)
    {
        try{
            $data = $folder->getList($request);
            return response(
                $data, 200
            );
        }catch(Exception $e){
            return response(
                [
                    'message' => $e->getMessage()
                ], 400
            );
        }
    }

    /**
     * Store a newly created folder in storage.
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
                    'description' => 'nullable|string'
                ]
            );

            //To create record in DB with all data from request. 
            // You have to ensure all the request attribute is exists in DB Table 
            // $folder->insert($request->all()); 

            //To create record in DB with all data from request 
            // but except _method, _token attribute. 
            // Folder::create($request->except(["_method", "_token"]));
            
            //To create record in DB with specified data from request 
            Folder::create(
                ["name" => $request->name, "description" => $request->description]
            );

            return response(
                [
                    'message' => "Data stored successfully.",
                ], 200
            );
        }catch(Exception $e){
            return response(
                [
                    'message' => $e->getMessage(),
                    // 'errors' => $e
                ], 400
            );
        }
    }

    /**
     * Update the specified folder in storage.
     *
     * @param \Illuminate\Http\Request $request 
     * @param int                      $id      folder id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        try{
            $this->validate(
                $request, 
                [
                    'name' => 'required|string|min:3|max:255', 
                    'description' => 'nullable|string'
                ]
            );
            // Folder::where("id", $id)->update(
            //     $request->except(["_method", "_token"])
            // );
            $folder = Folder::find($id);
            $folder->name = $request->name;
            $folder->description = $request->description;
            $folder->save();

            return response(
                [
                    'message' => "Data updated successfully.",
                ], 200
            );

        }catch(Exception $e){
            return response(
                [
                    'message' => $e->getMessage()
                ], 400
            );
        }
    }

    /**
     * Remove the specified folder from storage.
     *
     * @param int $id folder id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try{
            
            // Folder::where("id", $id)->delete();
            $folder = Folder::find($id);
            if ($folder) {
                $folder->delete();
            }

            return response(
                [
                    'message' => "Data deleted successfully.",
                ], 200
            );

        }catch(Exception $e){
            return response(
                [
                    'message' => $e->getMessage()
                ], 400
            );
        }
    }
}
