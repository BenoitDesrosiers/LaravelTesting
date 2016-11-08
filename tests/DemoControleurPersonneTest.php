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
     * 
     * rqt-4 CRUD des personnes
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
     * 
     * rqt-4 CRUD des personnes 
     * il y aurait normalement une entré dans le dictionnaire indiquant
     * les champs à mettre sur l'index. 
     */
    public function le_ctrl_envoie_les_personnes_a_la_view()
    {
    	$this->visit('/personnes')
    	    ->assertViewHas('personnes')
    	    ->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->response->original->getData()['personnes'] );
    }
    
    /**
     * @test
     * 
     * rqt-4 CRUD des personnes. 
     * il pourrait y avoir une exigence indiquant le nombre d'entrées
     * à mettre par page. 
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
     * 
     * rqt-4 CRUD des personnes + dictionnaire nom obligatoire. 
     */
    public function le_ctrl_retourne_errors_avec_une_personne_sans_nom()
    {
    	$this->call('POST', '/personnes');
    	$this->assertSessionHasErrors(['nom']);
    }

    /**
     * @test
     * 
     * rqt-4 CRUD des personnes + dictionnaire date naissance obligatoire 
     * (il faudrait ajouter un test sur le format de la date de naissance)
     */
    public function le_ctrl_retourne_errors_avec_une_personne_sans_dateNaissance()
    {
    	$this->call('POST', '/personnes');
    	$this->assertSessionHasErrors(['dateNaissance']);
    }
    
    /**
     * @test
     * 
     * rqt-4 CRUD des personnes
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
     * 
     * rqt-6 sauvegarde des personnes dans la bd. 
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




