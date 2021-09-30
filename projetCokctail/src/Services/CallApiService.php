<?php
 namespace App\Services;

use DateTime;
use Symfony\Contracts\HttpClient\HttpClientInterface;
  
 class CallApiService
 {
     private $client;
  
     public function __construct(HttpClientInterface $client)
     {
         $this->client = $client;
     }
  
     public function getCategories(): array
     {  
        $json = file_get_contents('https://www.thecocktaildb.com/api/json/v1/1/list.php?c=list');
        $obj = json_decode($json);
        $values = array();
        foreach($obj as $record){
            foreach($record as $value){
                array_push($values,$value);

            }       
            
        } 
        return $values;
     }
     
     public function getIngredients(): array
     {  
        $json = file_get_contents('https://www.thecocktaildb.com/api/json/v1/1/list.php?i=list');
        $obj = json_decode($json);
        $values = array();
        foreach($obj as $record){
            foreach($record as $value){
                array_push($values,$value);

            }       
            
        } 
        return $values;
     }

     public function getCateg($id){
         return $this->getCategories()[$id];
     }
     
     public function getIngredient($id){
        return $this->getIngredients()[$id];
      }



     
   

     public function getAllCocktails():array{
        $categories = $this->getIngredients();
        $values = array(); 
        foreach($categories as $categorie){
            $json = file_get_contents('https://www.thecocktaildb.com/api/json/v1/1/filter.php?i='.$categorie->strIngredient1);
            $obj = json_decode($json);
          
            foreach($obj as $record){
                foreach($record as $value){
                    array_push($values,$value);
    
                }       
                
            } 
            break;
           
        }
        return $values;

     }
     public function getIngredientsByCat($id):array{
        $categorie = $this->getIngredient($id);

     
        $values = array(); 

            $json = file_get_contents('https://www.thecocktaildb.com/api/json/v1/1/filter.php?i='.$categorie->strIngredient1);
            $obj = json_decode($json);
          
            foreach($obj as $record){
                foreach($record as $value){
                    array_push($values,$value);
    
                }       
                
         
           
        }
        return $values;

     }


     public function getCocktailsByCat($id):array{
        $categorie = $this->getCateg($id);
        $values = array(); 

            $json = file_get_contents('https://www.thecocktaildb.com/api/json/v1/1/filter.php?c='.$categorie->strCategory);
            $obj = json_decode($json);
          
            foreach($obj as $record){
                foreach($record as $value){
                    array_push($values,$value);
    
                }       
                
         
           
        }
        return $values;

     }


     public function getRandomCocktail(){

        
        $json = file_get_contents("https://www.thecocktaildb.com/api/json/v1/1/random.php");
        $obj = json_decode($json);
        $values = array(); 
        foreach($obj as $record){
            foreach($record as $value){
                array_push($values,$value);

            }       
            
        } 
       
    return $values;
     }


     public function getCocktailsById($id){
            
      
            $json = file_get_contents('https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i='.$id);
            $obj = json_decode($json);
            $values = array(); 
            foreach($obj as $record){
                foreach($record as $value){
                    array_push($values,$value);
    
                }       
                
            } 
           
        return $values;
     }


     


 }

?>