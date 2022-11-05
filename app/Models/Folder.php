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
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Folder model
 * 
 * @category Category
 * @package  Package
 * @author   Delwar Sumon <delwarsumon0@gmail.com>
 * @license  MIT http://url.com
 * @link     http://url.com
 */
class Folder extends Model
{
    use HasFactory;
    public $fillable = ['name', 'description'];
    protected $table = "folders";

    /**
     * Pull records from storage with some filtering.
     * 
     * @param object $params are request attribute
     * 
     * @return array of results and filtering info
     */
    function getList( object $params) 
    {
        // Check the params and prepared it to use in filtering. 
        // If params not exists, default value for -
        // skip = 0, take = 10, sort_by = 'id', sort_order = 'asc
        $page = ($params->page) ? $params->page : 0;
        $skip = ($params->page) ? (($params->page - 1) * $params->per_page) : 0;
        $take = ($params->per_page) ? $params->per_page : 10;
        $sort_by = ($params->sort_by) ? $params->sort_by : "id";
        $sort_order = ($params->sort_order) ? $params->sort_order : "asc";

        if (!in_array(
            $sort_by, array("id", "name", "description", "created_at", "updated_at")
        )
        ) {
            return array(
                'message' => $sort_by . " field not found for sorting",
                'data' => []
            );
        }

        $data = DB::table("folders")->take($take)->skip($skip)
            ->orderBy($sort_by, $sort_order)->get();

        return array(
            'data' => $data,
            'info' => array(
                'page' => $page,
                'per_page' => $take,
                'sort_by' => $sort_by,
                'sort_order' => $sort_order
            )
        );
    }
}
