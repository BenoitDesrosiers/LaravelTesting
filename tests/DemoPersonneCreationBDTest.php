<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Personne;

class DemoPersonneCreationBDTest extends TestCase
{
	use DatabaseTransactions;
	
    /**
     * @test 
     * 
     * rqt-6: sauvegarder les personnes dans une BD 
     */
    public function sauvegarde_d_un_bon_modele_avec_telephone()
    {
    	$personne = new Personne;
    	$personne->nom = "Nom Valide";
    	$personne->dateNaissance = '2000-12-25';
    	$personne->telephone = "123-123-1234";
    	$this->assertTrue($personne->save());
    	$this->seeInDatabase('personnes', [
    			'id'=>$personne->id,
    			'nom'=>$personne->nom,
    			'dateNaissance'=>$personne->dateNaissance,
    			'telephone'=>$personne->telephone
    	]);
    	
    }
    /**
     * @test
     *
     * rqt-6: sauvegarder les personnes dans une BD
     */
    public function sauvegarde_d_un_bon_modele_sans_telephone()
    {
    	$personne = new Personne;
    	$personne->nom = "Nom Valide";
    	$personne->dateNaissance = '2000-12-25';
    	$this->assertTrue($personne->save());
    	$this->seeInDatabase('personnes', [
    			'id'=>$personne->id,
    			'nom'=>$personne->nom,
    			'dateNaissance'=>$personne->dateNaissance,
    			'telephone'=>$personne->telephone
    	]);
    	 
    }
}
