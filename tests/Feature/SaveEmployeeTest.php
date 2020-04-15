<?php

namespace chirag\Employee\Tests;

use chirag\Employee\QuickEmployee;
use Illuminate\Support\Facades\Artisan;

class SavePostsTest extends Testcase
{
    //use RefreshDatabase;

    /** @test */
    public function saveEmployeeData()
    {
        factory(QuickEmployee::class)->create();
        $this->assertCount(1, QuickEmployee::all());
    }
}
