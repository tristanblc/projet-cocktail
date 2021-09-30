<?php

namespace App\Controller;

use App\Services\CallApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    private  $callApiService;

    public function __construct(CallApiService $callApiService){
        $this->callApiService = $callApiService;
    }
    
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'cocktails' => $this->callApiService->getAllCocktails()
        ]);
    }
    
    
  
    /**
     * @Route("/categorie", name="app_values_dep")
     */

    public function indexCat(): Response
    {
        return $this->render('pages/cat.html.twig', [
            'categories' =>  $this->callApiService->getCategories(),
            'ingredients' => null
        ]);
    }

         /**
     * @Route("/ingredient/{id}", name="app_values_ingredient_choice")
     */

    public function indexListeIngredient($id): Response
    {
        return $this->render('pages/ingredients.html.twig', [
            'ingredients' => $this->callApiService->getIngredients(),
            'boissons' =>  $this->callApiService->getIngredientsByCat($id)
        ]);
    }

      /**
     * @Route("/ingredient", name="app_values_ingredient")
     */

    public function indexingredient(): Response
    {
        return $this->render('pages/ingredients.html.twig', [
            'ingredients' => $this->callApiService->getIngredients(),
            'boissons' => null
        ]);
    }
      /**
     * @Route("/categorie/{id}", name="app_values_categorie_choice")
     */

    public function indexCocktailByCategorie($id): Response
    {
        return $this->render('pages/cat.html.twig', [
            'categories' => $this->callApiService->getCategories(),
            'ingredients' => $this->callApiService-> getCocktailsByCat($id)
            
        ]);
    }
    
   /**
     * @Route("/cocktails/{id}", name="app_values_cocktails")
     */

    public function indexCocktailInfo($id): Response
    {
        return $this->render('pages/cocktails.html.twig', [
            'categories' => $this->callApiService->getCocktailsById($id),
            'title' => " Information du breuvage"
            
        ]);
    }
/**
     * @Route("/random", name="app_values_random")
     */

    public function indexCocktailRandom(): Response
    {
        return $this->render('pages/cocktails.html.twig', [
            'categories' => $this->callApiService->getRandomCocktail(),
            'title' => " Boisson aléatoire"
            
        ]);
    }

}
