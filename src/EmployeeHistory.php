<?php

namespace chirag\Employee;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeHistory extends Model
{
    use SoftDeletes;
    protected $table = 'employee_web_history';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $fillable = ['ip_address', 'urls'];
    //public $timestamps = false;
    protected $dates = ['deleted_at'];

}