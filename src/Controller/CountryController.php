<?php

namespace App\Controller;

use App\Form\CountryType;
use App\Repository\CountryRepository;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CountryController extends AbstractController
{
    /**
     * @Route("/country", name="country", methods={"GET","POST"})
     */
    public function index(Request $request, CountryRepository $countryRepository, PersonRepository $personRepository): Response
    {
        $form = $this->createForm(CountryType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->render('person/index.html.twig', [
                'people' => $personRepository->findBy (['country' => $countryRepository->findOneBy (['id' => $form->getData()->getCountry()])]),
            ]);
        }
        return $this->render('country/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
