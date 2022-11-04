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
        // skip = 0, take = 10, sort_column = 'id', order_by = 'asc
        $skip = ($params->page) ? (($params->page - 1) * $params->page) : 0;
        $take = ($params->per_page) ? $params->per_page : 10;
        $sort_column = ($params->sort_column) ? $params->sort_column : "id";
        $order_by = ($params->order_by) ? $params->order_by : "asc";

        $data = DB::table("folders")->take($take)->skip($skip)
            ->orderBy($sort_column, $order_by)->get();

        return array(
            'data' => $data,
            'info' => array(
                'page' => $skip,
                'per_page' => $take,
                'sort_column' => $sort_column,
                'order_by' => $order_by
            )
        );
    }
}
