<?php

namespace App\Controller;

use App\ExpensiveCalculationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CacheController extends AbstractController
{
    private $expensiveCalculationService;

    public function __construct(ExpensiveCalculationService $expensiveCalculationService)
    {
        $this->expensiveCalculationService = $expensiveCalculationService;
    }

    /**
     * @Route("/no-cache", name="no_cache")
     */
    public function noCache(): Response
    {
        for ($i = 0; $i < 3; ++$i) {
            $this->expensiveCalculationService->calculate();
        }

        return $this->render('cache.html.twig');
    }
}
