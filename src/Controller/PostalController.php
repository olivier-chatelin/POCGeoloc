<?php

namespace App\Controller;

use App\Service\ApiConnexion;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


    /**
     * @Route("/postal", name="postal_")
     */
class PostalController extends AbstractController
{
    /**
     * @Route("/", name="form")
     */
    public function index(Request $request): Response
    {
        $defaultData = ['message' => 'Type your message here'];
        $form = $this->createFormBuilder($defaultData)
            ->add('postalCode', TextType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $postalCode = $form->getData();
            $apiConnexion = new ApiConnexion();
            $cityData = $apiConnexion->getCityName($postalCode
            );
            return $this->render('test/index.html.twig', ['cityData'=>$cityData]);
        }
        return $this->render('postal/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
