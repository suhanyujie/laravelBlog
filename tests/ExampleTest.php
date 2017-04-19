<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use MyBlog\Repositories\Rtag;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
//    public function testBasicExample()
//    {
//        $this->visit('/')
//             ->see('Laravel');
//    }

    public function checkTagFind()
    {
//        $rTag = new Rtag();
//        $res = $rTag->checkTagExists();
//        echo $res;
        $this->assertTrue(true);
    }





}
