<?php
namespace App\Controller\Admin;


use App\Entity\Option;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminPropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository ;
        $this->em = $em ;
    }

    /**
     * @Route("/admin", name="admin.property.index")
     * @return Response
     */
    public function index(): Response
    {
           $properties = $this->repository->findAll() ;
           return $this->render('admin/property/index.html.twig', compact('properties')) ;
    }

    /**
     * @Route("/admin/property/create", name="admin.property.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $property = new Property() ;

        $form = $this->createForm(PropertyType::class, $property) ;
        $form->handleRequest($request) ;

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien créé avec succès');
            return $this->redirectToRoute('admin.property.index') ;
        }

        return $this->render('admin/property/new.html.twig', [
            'property' => $property ,
            'form' => $form->createView() ,
        ]) ;
    }

    /**
     * @Route("/admin/property/{id}" , name="admin.property.edit", methods="GET|POST")
     * @param Property $property
     * @param Request $request
     * @return Response
     */
    public function edit(Property $property, Request $request): Response
    {
        //$option = new Option() ;
        //$property->addOption($option) ;

        $form = $this->createForm(PropertyType::class, $property) ;
        $form->handleRequest($request) ;

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.property.index') ;
        }

        return $this->render('admin/property/edit.html.twig', [
            'property' => $property ,
            'form' => $form->createView() ,
        ]) ;
    }

    /**
     * @Route("/admin/property/{id}" , name="admin.property.delete", methods="DELETE")
     * @param Property $property
     * @param Request $request
     * @return Response
     */
    public function delete(Property $property, Request $request): Response
    {
        if($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token'))) {
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');
        }
        return $this->redirectToRoute('admin.property.index') ;
    }
}
