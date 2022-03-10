<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController
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
        return new Response( sprintf(
            '<html>
                        <body>
                            <h1>Choose your pizza!</h1>
                            <p>Your pizza is "%s"!', ucwords(str_replace('-', ' ', $slug)), '</p>
                        </body>
                    </html>'));
    }
}