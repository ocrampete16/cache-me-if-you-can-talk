<?php

declare(strict_types=1);

namespace App\Controller;

use App\ExpensiveCalculationService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
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
        return $this->render('cache.html.twig', [
            'color' => $this->expensiveCalculationService->calculate(),
        ]);
    }

    /**
     * @Route("/expiration", name="expiration")
     * @Cache(smaxage=5)
     */
    public function expiration(): Response
    {
        return $this->render('cache.html.twig', [
            'color' => $this->expensiveCalculationService->calculate(),
        ]);
    }

    /**
     * @Route("/no-esi", name="no_esi")
     */
    public function noEsi(): Response
    {
        return $this->render('fragments.html.twig', ['esi' => false]);
    }

    /**
     * @Route("/esi", name="esi")
     */
    public function esi(): Response
    {
        return $this->render('fragments.html.twig', ['esi' => true]);
    }
}
