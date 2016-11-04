<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DemoControleurPersonneTest extends TestCase
{
	use DatabaseTransactions;
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
    
    /**
     * @test
     */
    public function le_ctrl_envoie_les_personnes_a_la_view()
    {
    	$this->visit('/personnes')
    	    ->assertViewHas('personnes')
    	    ->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->response->original->getData()['personnes'] );
    }
    
    /**
     * @test
     */
    public function le_ctrl_envoie_toutes_les_personnes_a_la_view()
    {
    	for($i = 0; $i< 5; $i++) {
    		$lesPersonnes[$i] = factory(App\Personne::class)->create();
    	}
    	$this->visit('/personnes')
    		->assertViewHas('personnes');
    	
    	$personnes = $this->response->original->getData()['personnes'] ;
    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$personnes );
    	$this->assertEquals(count($lesPersonnes), $personnes->count());
    }
    
}
