<?php
namespace App\Controller\user;

use App\Entity\Colis;
use App\Entity\Users;
use App\Form\RegistrationColisType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType ;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class ColiController extends Controller{
    /**
     * @Route("/coli/{id}",name="coli_list")
     * @Method({{"GET","POST"}})
     */
    public function index($id,Request $request): Response{
   
        $user= $this->getDoctrine()->getRepository(Users::class)->findOneBy( array ('id' => $id));
     
     
        $colis= $this->getDoctrine()->getRepository(Colis::class)->findAll();
     
     
  // Paginate the results of the query
  $colis = $this->get('knp_paginator')->paginate(
    // Doctrine Query, not results
    $colis,
    // Define the page parameter
    $request->query->getInt('page', 1),
    // Items per page
    2
);
        
 return $this->render('User/coli/index.html.twig', array('coli'=> $colis, 'user' =>$user)); }
    
/**
 * @Route("/coli/new/{id} ",name="new_coli")
 *  @Method({{"GET","POST"}})
 */

public function new(Request $request,$id):Response{
    $colis= new Colis();
    $user= $this->getDoctrine()->getRepository(Users::class)->findOneBy( array ('id' => $id));
    $user->getId();
    $colis->setUser($user);
    $form = $this->createForm(RegistrationColisType::class, $colis);
    $form->handleRequest($request);   
     
    
    if ($form->isSubmitted() && $form->isValid() ) {
        if($form->get('Categorie')->getData()=='Electroniques'){
       $colis->setPath('/Uploads/ImagesColis/small_2.jpg');
        }
         
        
         else if ($form->get('Categorie')->getData()=='Vetements'){
            $colis->setPath('/Uploads/ImagesColis/sprayed_bg.jpg');
        }
        
            else if($form->get('Categorie')->getData()=='Nourritures'){
                $colis->setPath('/Uploads/ImagesColis/small_2.jpg');
        }
            else if($form->get('Categorie')->getData()=='Medicaments'){
            // insertion d'une image 
        }
            else if($form->get('Categorie')->getData()=='Papiers'){
            // insertion d'une image 
        }
            else{
            // insertion d'une image selon l'autre categorie 
        }
        $file = $form['image']->getData();
           
        $filename = md5(uniqid()).'.'.$file->guessExtension();
        try{
            $file->move(
                $this->getParameter('uploads_directory'),
                $filename
            );
        }catch(FileException $e){

        }

        
        $entityManager = $this->getDoctrine()->getManager();
        $colis->setImage($filename);
        $entityManager->persist($colis);
      
        $entityManager->persist($user);
        $entityManager->flush();
      

    
        return $this->redirect ($this->generateUrl('coli_list', array( 'id' => $id )));
      

    }
   
    return $this->render('User/coli/new.html.twig',array
    ('form'=> $form->createView(),'user'=> $user, 'coli'=>$colis));

 }
 
    

    
  
 /**
  * @Route("/colisedit/{id}/{idu}", name="edit_colis")
  * @Method({{"GET","POST"}})
  */
  public function edit(Request $request, $id,$idu) {
  $colis =new Colis();
  
    $user = $this->getDoctrine()->getRepository(Users::class)->findOneBy( array ('id' => $idu));
      

    $colis = $this->getDoctrine()->getRepository(Colis::class)->findOneBy( array ('id' => $id));
      

    $form = $this->createFormBuilder($colis, [
        'validation_groups' => ['registration'],
    ])
  
    ->add('Point_De_Depart',CountryType::class, [
    
        'error_mapping' => [
            'matchingCityAndZipCode' => 'city',
        ],
    ])
    ->add('Point_D_Arriver',CountryType::class, [
    
        'error_mapping' => [
            'matchingCityAndZipCode' => 'city',
        ],
    ])
    ->add('Date_De_Depart',DateType::class,[
        'placeholder' => [
            'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
        ]
    ])
    ->add('Date_D_Arriver',DateType::class,[
        'placeholder' => [
            'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
        ]
    ])
    ->add('Heure_D_Arriver', TimeType::class, [
        'input'  => 'string',
        'widget' => 'choice',
    ])
    ->add('Size', ChoiceType::class, [
        'choices' => [
            '[1kg-5kg]' => 'small ' ,
            '[5kg-10kg]' => 'Medium',
            '[10kg-15kg]' => 'large',
        ],])
    ->add('Categorie', ChoiceType::class, [
        'choices' => [
            'Electroniques' => 'Electroniques' ,
            'Vetements' => 'Vetements',
            'Nourritures' => 'Nourritures',
            'Medicaments' => 'Medicaments',
            'Papiers' => 'Papiers',
          

        ],])
    ->add('Type')
    ->add('Prix')
    ->add('image',FileType::class, array('required' => false,'data_class'=> null)
        )
   
    
    ->add('Modifier', SubmitType::class , [
        'attr' => [
            'class'=> 'btn btn-outline-success'
        ]
    ])

        
    -> getForm();
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
        $file = $form['image']->getData();
           
        $filename = md5(uniqid()).'.'.$file->guessExtension();
        try{
            $file->move(
                $this->getParameter('uploads_directory'),
                $filename
            );
        }catch(FileException $e){

        }

        
      $entityManager = $this->getDoctrine()->getManager();
      $colis->setImage($filename);
      $entityManager->persist($colis);
    
      
      $entityManager->flush();
      return $this->redirect ($this->generateUrl('coli_list', array( 'id' => $idu)));
    }

     

    return $this->render('User/coli/edit.html.twig', array(
      'form' => $form->createView(),'user'=> $user, 'coli'=>$colis
    ));
  }
  public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults([
      
        'validation_groups' => ['registration'],
    ]);
}


 

    /**
     * @Route("/coliShow/{id}/{idu}",name="coli_show")
     */

   
    public function affichercoli($id,$idu) {
        $user= $this->getDoctrine()->getRepository(Users::class)->findOneBy( array ('id' => $idu));

         $coli = $this->getDoctrine()->getRepository(Colis::class)->findOneBy(array('id'=>$id));
          return $this->render('User/coli/show.html.twig',array('coli'=> $coli, 'user'=>$user)); 
        } 
    /**
     * @Route("/colis/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id){
        $coli = $this->getDoctrine()->getRepository(Colis::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
     
        $entityManager->remove($coli);
      
      
        $entityManager->flush();
        $response = new Response();
        $response->send();
   
    }
   
}


   

