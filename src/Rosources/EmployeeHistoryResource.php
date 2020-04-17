<?php


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
        return null;
    }
}