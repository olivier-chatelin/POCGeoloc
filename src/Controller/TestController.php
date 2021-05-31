<?php

namespace App\Controller;

use App\Service\ApiConnexion;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TestController extends AbstractController
{
    /**
     * @Route("/", name="test_")
     */
    public function index(Request $request): Response
    {

        $defaultData = ['message' => 'Type your message here'];
        $form = $this->createFormBuilder($defaultData)
            ->add('postalCode', TextType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $data = $form->getData();
            $postalCode = $data['postalCode'];
            $apiConnexion = new ApiConnexion();
            $cityData = $apiConnexion->getCityName($postalCode
            );
            return $this->render('test/index.html.twig', ['cityData'=>$cityData,'form' => $form->createView()]);
        }
        return $this->render('test/index.html.twig', [
            'form' => $form->createView(),
            'cityData' => null
        ]);
    }
}
