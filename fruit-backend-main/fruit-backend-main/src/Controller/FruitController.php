<?php

namespace App\Controller;

use App\Service\FruitService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/fruit")
 */
class FruitController extends AbstractController
{
    private $fruitService;

    public function __construct(FruitService $fruitService)
    {
        $this->fruitService = $fruitService;
    }

    /**
     * @Route("", methods={"GET"})
     * 
     * @param Request $request
     * @return Json
     */
    #[Route('/api/fruit', methods: ['GET', 'HEAD'])]
    public function index(Request $request): Response
    {
        $res = $this->fruitService->search($request);
        return $this->json(
            $res,
            headers: ['Content-Type' => 'application/json;charset=UTF-8']
        );
    }
}
