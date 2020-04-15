<?php
/**
 * Created by PhpStorm.
 * User: Neha
 * Date: 4/13/2020
 * Time: 9:08 PM
 */

namespace chirag\Employee\Rosources;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(!empty(parent::toArray($request))) {
            return ['employee' =>  parent::toArray($request)];
        }
        return "NULL";
    }
}