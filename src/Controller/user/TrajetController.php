<?php
namespace App\Controller\user;

use App\Entity\Trajet;
use App\Entity\Users;
use App\Form\RegistrationTrajetType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType ;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class TrajetController extends AbstractController{
     /**
     * @Route("/trajet/{id}",name="trajet_list")
     * @Method({{"GET","POST"}})
     */
    public function index($id,Request $request): Response{
   
        $user= $this->getDoctrine()->getRepository(Users::class)->findOneBy( array ('id' => $id));
     
     
        $trajet= $this->getDoctrine()->getRepository(Trajet::class)->findAll();
     
     
 
 return $this->render('User/Trajet/index.html.twig', array('trajet'=> $trajet, 'user' =>$user));
 }
/**
 * @Route("/trajet/new/{id} ",name="new_trajet")
 *  @Method({{"GET","POST"}})
 */

public function new(Request $request,$id):Response{
    $trajet= new Trajet();
    $user= $this->getDoctrine()->getRepository(Users::class)->findOneBy( array ('id' => $id));
    $user->getId();
    $trajet->setUser($user);
    $form = $this->createForm(RegistrationTrajetType::class, $trajet);
    $form->handleRequest($request);   
     
    
    if ($form->isSubmitted() && $form->isValid() ) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($trajet);
      
        $entityManager->persist($user);
        $entityManager->flush();
      

    
        return $this->redirect ($this->generateUrl('trajet_list', array( 'id' => $id )));
      

    }
    return $this->render('User/Trajet/new.html.twig',array
    ('form'=> $form->createView(),'user'=> $user, 'trajet'=>$trajet));

}
 /**
  * @Route("/trajetedit/{id}/{idu}", name="edit_trajet")
  * @Method({{"GET","POST"}})
  */
  public function edit(Request $request, $id,$idu) {

    
      $user = $this->getDoctrine()->getRepository(Users::class)->findOneBy( array ('id' => $idc));
        
  
      $trajet = $this->getDoctrine()->getRepository(Trajet::class)->findOneBy( array ('id' => $id));
        
  
      $form = $this->createFormBuilder($trajet)
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
      ->add('Heure_De_Depart', TimeType::class, [
        'input'  => 'string',
        'widget' => 'choice',
    ])
      ->add('Heure_D_Arriver', TimeType::class, [
          'input'  => 'string',
          'widget' => 'choice',
      ])
     
      ->add('Modifier', SubmitType::class , [
          'attr' => [
              'class'=> 'btn btn-outline-success'
          ]
      ])
  
          
      -> getForm();
      $form->handleRequest($request);
  
      if($form->isSubmitted() && $form->isValid()) {
          
  
          
        $entityManager = $this->getDoctrine()->getManager();
     
        $entityManager->flush();
        return $this->redirect ($this->generateUrl('trajet_list', array( 'id' => $idu )));
      }
  
       
  
      return $this->render('User/Trajet/edit.html.twig', array(
        'form' => $form->createView(),'user'=> $user, 'trajet'=>$trajet
      ));
    }
    
      /**
       * @Route("/trajetShow/{id}/{idu}",name="trajet_show")
       */
  
     
      public function affichertrajet($id,$idu) {
          $user= $this->getDoctrine()->getRepository(Users::class)->findOneBy( array ('id' => $idc));
  
           $trajet= $this->getDoctrine()->getRepository(Trajet::class)->findOneBy(array('id'=>$id));
            return $this->render('User/Trajet/show.html.twig',array('trajet'=> $trajet, 'user'=>$user)); 
          } 
     /**
     * @Route("/trajet/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id){
        $trajet = $this->getDoctrine()->getRepository(Trajet::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
     
        $entityManager->remove($trajet);
      
      
        $entityManager->flush();
        $response = new Response();
        $response->send();
   
    }
   


}