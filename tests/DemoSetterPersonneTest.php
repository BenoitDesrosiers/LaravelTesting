<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Personne;

class DemoSetterPersonneTest extends TestCase
{
    /**
     * @test
     * 
     *  rqt-7: convertir une date en format AA-MM-JJ en AAAA-MM-JJ
     */
    public function le_format_date_aa_mm_jj_est_bien_converti()
    {
       $personne = new personne; 
        $personne->dateNaissance = "70-12-25";
        $this->assertTrue("1970-12-25"==$personne->dateNaissance);
        $personne->dateNaissance = "99-12-25";
        $this->assertTrue("1999-12-25"==$personne->dateNaissance);
        $personne->dateNaissance = "00-12-25";
        $this->assertTrue("2000-12-25"==$personne->dateNaissance);
        $personne->dateNaissance = "69-12-25";
        $this->assertTrue("2069-12-25"==$personne->dateNaissance);
        
    }
    
    /**
     * @test
     * @expectedException Exception 
     *  rqt-7: convertir une date en format AA-MM-JJ en AAAA-MM-JJ
     */
    public function une_mauvaise_date_fait_une_exception()
    {
    	$personne = new personne;
    	$personne->dateNaissance = "allo";
    }
    
    /**
     * @test
     *
     *  rqt-8: la date peut être entrée dans le format AAAA-MM-JJ
     */
    public function le_format_date_aaaa_mm_jj_est_valide()
    {
    	$personne = new personne;
    	$personne->dateNaissance = "2000-12-25";
    	$this->assertTrue("2000-12-25"==$personne->dateNaissance);
    	$personne->dateNaissance = "1999-12-25";
    	$this->assertTrue("1999-12-25"==$personne->dateNaissance);
    	$personne->dateNaissance = "3000-12-25";
    	$this->assertTrue("3000-12-25"==$personne->dateNaissance);
    	$personne->dateNaissance = "1869-12-25";
    	$this->assertTrue("1869-12-25"==$personne->dateNaissance);
    
    }
    
}
