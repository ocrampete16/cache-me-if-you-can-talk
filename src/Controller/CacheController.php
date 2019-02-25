<?php

declare(strict_types=1);

namespace App\Controller;

use App\ColorChooser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CacheController extends AbstractController
{
    private $colorChooser;

    public function __construct(ColorChooser $colorChooser)
    {
        $this->colorChooser = $colorChooser;
    }

    /**
     * @Route("/no-cache", name="no_cache")
     */
    public function noCache(): Response
    {
        return $this->render('cache.html.twig', [
            'color' => $this->colorChooser->random(),
        ]);
    }

    /**
     * @Route("/expiration", name="expiration")
     * @Cache(smaxage=5)
     */
    public function expiration(): Response
    {
        return $this->render('cache.html.twig', [
            'color' => $this->colorChooser->random(),
        ]);
    }

    /**
     * @Route("/validation", name="validation")
     */
    public function validation(Request $request): Response
    {
        $response = new Response();
        $response->setPublic();
        $response->setEtag($this->fetchEtag());

        if ($response->isNotModified($request)) {
            return $response;
        }

        return $this->render(
            'cache.html.twig',
            ['color' => $this->colorChooser->random()],
            $response
        );
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

    private function fetchEtag(): string
    {
        return md5((string) intdiv(time(), 5));
    }
}
