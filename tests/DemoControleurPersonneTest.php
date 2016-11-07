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
    
    
    /*
     * tests des paramètres de sortie de la view Index
     * 
     */
    
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
    
    /*
     *  tests des paramètres d'entrée de la view store pour une personne
     *  
     */
    
    /**
     * @test
     */
    public function le_ctrl_retourne_errors_avec_une_personne_sans_nom()
    {
    	$this->call('POST', '/personnes');
    	$this->assertSessionHasErrors(['nom']);
    }

    /**
     * @test
     */
    public function le_ctrl_retourne_errors_avec_une_personne_sans_dateNaissance()
    {
    	$this->call('POST', '/personnes');
    	$this->assertSessionHasErrors(['dateNaissance']);
    }
    
    /**
     * @test
     */
    public function le_ctrl_permet_la_creation_d_une_personne_valide()
    {
    	$personne_valide = factory(App\Personne::class)->make();
    	$input = ['nom'=>$personne_valide->nom, 'dateNaissance'=>$personne_valide->dateNaissance];
    	$this->call('POST', '/personnes', $input);    	 
    	$this->assertSessionMissing(['errors']);
    }
    
    /*
     *  tests de la sauvegarde d'une personne par le store
     */
    
    /**
     * @test
     */
    public function le_ctrl_permet_la_sauvegarde_d_une_personne_valide()
    {
    	$personne_valide = factory(App\Personne::class)->make();
    	$input = ['nom'=>$personne_valide->nom, 
    			  'dateNaissance'=>$personne_valide->dateNaissance, 
    			  'telephone' => $personne_valide->telephone];
    	$this->call('POST', '/personnes', $input);
    	$this->assertSessionMissing(['errors']);
    	$this->seeInDatabase('personnes', ['nom' => $personne_valide->nom, 
    									   'dateNaissance' => $personne_valide->dateNaissance,
    									   'telephone' => $personne_valide->telephone]);
    	
    }
 
}




