<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Pizza;
use App\Repository\CategoryRepository;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     **/
    public function homepage(EntityManagerInterface $em)
    {
        $slug = [
            'pizza_vlees',
            'pizza_vega',
            'pizza_vis',
        ];
        $repository = $em->getRepository(Category::class);
        /** @var Category $category */
        $categories = $repository->findAll();

        return $this->render('question/homepage.html.twig', [
            'categories' => $categories
        ]);
    }
    /**
     * @Route("/pizza/{id}", name="app_cat")
     **/
    public function pizza(Category $category, PizzaRepository $pizzaRepository) {

        $pizza = $pizzaRepository->findBy(['Article' => $category]);
/*
        $repository = $em->getRepository(Category::class);
        /** @var Category $category
        $categories = $repository->findAll();

        $category=$em->getRepository(Category::class)
            ->find($id);
        $pizzas=$category->getPizzas();
        if (!$pizzas) {
            throw $this->createNotFoundException(sprintf('No category for slug "%s"', $id));
        }*/


        return $this->render('question/pizza.html.twig', [
            'id' => $category,
            'pizzas' => $pizza
        ]);

    }
}