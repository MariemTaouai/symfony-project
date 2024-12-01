<?php

namespace App\Controller;


use App\Repository\BorrowingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReportController extends AbstractController
{
    #[Route('/BoorowingBook', name: 'most_popular_book')]
    public function index(BorrowingRepository $repository): Response
    {

        $books = $repository->findMostPopularBooksDql();

        return $this->render('report/index.html.twig', [
            'controller_name' => 'ReportController',
            'books' => $books,
        ]);

    }   


}
