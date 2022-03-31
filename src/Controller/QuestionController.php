<?php

namespace App\Controller;

use App\Entity\Category;
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
     * @Route("/pizza/{slug}", name="pizza_category")
     **/
    public function pizza($slug, EntityManagerInterface $em) {

        $pizza = [
            'Vlees',
            'Vegatrisch',
            'Vis',
            ];
        $repository = $em->getRepository(Category::class);
        /** @var Category $category */
        $category = $repository->findOneBy(['slug' => $slug]);
        if (!$category) {
            throw $this->createNotFoundException(sprintf('No category for slug "%s"', $slug));
        }

        dump($slug, $this);

        return $this->render('question/pizza.html.twig', [
            'question' => ucwords(str_replace('-', ' ', $slug)),
            'answers' => $pizza,
            'category' => $category,
        ]);

    }
}