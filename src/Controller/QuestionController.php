<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/")
     **/
    public function homepage() {

        return new Response("<html><body><h1>Welcome to my first Symfony site!</h1></body></html>");
    }

    /**
     * @Route("/pizza/{slug}")
     **/
    public function pizza($slug) {

        $answers = [
            'Is there enough cheese on the pizza',
            'What it is not diffided on the pizza!?',
            'More tuna!!',
            ];

        return $this->render('question/pizza.html.twig', [
            'question' => ucwords(str_replace('-', ' ', $slug)),
            'answers' => $answers,
        ]);

    }
}