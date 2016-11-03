<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DemoControleurPersonneTest extends TestCase
{
    /**
     *
     * @test
     */
    public function les_routes_CRUD_existent()
    {
        $this->visit("/personnes"); //index
        $this->visit("/personnes/create"); //create
        $this->visit("/personnes/edit"); //update
        $this->visit("/personnes/show"); //read
        
    }
}
