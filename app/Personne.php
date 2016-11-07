<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;
use DateTime;

class Personne extends Model
{
	
	/**
	 * les attributs qui sont "mass assignable"
	 */
	
	protected $fillable = ['nom', 'dateNaissance', 'telephone'];
	
    /*
     * converti une date du format yy-mm-dd à yy-mm-dd. 
     * Si yy > 69 ajoute 1900, sinon ajoute 2000 (suit le format y de Datetime::createFromFormat
     * 
     * Si la date est envoyé en format yyyy-mm-dd, alors fait une simple validation que c'est une bonne date
     * 
     * Si le format ne respecte pas une de ces deux format ou que c'est une date invalide, retourne une exception. 
     */
	public function setDateNaissanceAttribute($value)
	{
		//essaie de convertir la date en supposant qu'elle est du format AA-MM-DD
		$dateConvertie = DateTime::createFromFormat('y-m-d', $value);
		if(!$dateConvertie) 
		//ce n'est pas le format AA-MM-DD, essaie avec AAAA-MM-DD
		{
			$dateConvertie = DateTime::createFromFormat('Y-m-d', $value);
			if(!$dateConvertie)
			//ce n'est ni AA ni AAAA, ou encore une date invalide
			{
			    throw new Exception('Mauvais format de date');	
			}	
		}
		$this->attributes['dateNaissance'] = $dateConvertie->format('Y-m-d');
	}
}
