<?php
/**
 * Created by PhpStorm.
 * User: Neha
 * Date: 4/13/2020
 * Time: 9:10 PM
 */

namespace chirag\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeHistory extends Model
{
    protected $table = 'employee_web_history';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $fillable = ['ip_address', 'urls'];
    
//    protected  $casts = [
//        'urls' => 'array'
//    ];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public static function getWebHistoryIpaddress($ip_address) {
        return self::find($ip_address);
    }

}