<?php
/**
 * Created by PhpStorm.
 * User: Neha
 * Date: 3/24/2020
 * Time: 5:58 PM
 */

namespace chirag\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuickEmployee extends Model
{
    use SoftDeletes;
    protected $table = 'employees';
    protected $guarded = [];
    protected $primaryKey = 'ip_address';
    protected $fillable = ['emp_id', 'epm_name', 'ip_address'];
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    //public $timestamps = false;


    public static function getEmpIpaddress($ip_address) {
        return self::find($ip_address);
    }
}