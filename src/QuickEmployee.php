<?php


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
    protected $softDelete = true;
    //public $timestamps = false;


}