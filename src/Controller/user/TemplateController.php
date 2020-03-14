<?php
namespace App\Controller\user;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityRepository;



class TemplateController extends AbstractController{
    /**
     * @Route("/",name="index")
     * @Method({{"GET","POST"}})
     */
    public function index(){
      

        return $this->render('User/Accueil/index.html.twig');
    }

   
     /**
     * @Route("/Apropos",name="Apropos")
     * @Method({{"GET","POST"}})
     */
    public function indexApropos(){
      

        return $this->render('User/Accueil/about.html.twig');
    }

     /**
     * @Route("/Apropos1/{id}",name="Apropos1")
     * @Method({{"GET","POST"}})
     */
    public function indexApropos1($id):Response{
        $user= $this->getDoctrine()->getRepository(Users::class)->findOneBy( array ('id' => $id));

        return $this->render('User/Accueil/about1.html.twig',array('user' =>$user  ));
    }


     /**
     * @Route("/contact",name="contact")
     * @Method({{"GET","POST"}})
     */
    public function indexContact(){
      

        return $this->render('User/Accueil/contact.html.twig');
    }
      /**
     * @Route("/contact1/{id}",name="contact1")
     * @Method({{"GET","POST"}})
     */
    public function indexContact1($id):Response{
        $user= $this->getDoctrine()->getRepository(Users::class)->findOneBy( array ('id' => $id));

        return $this->render('User/Accueil/contact1.html.twig',array('user' =>$user  ));
    }

     /**
     * @Route("/Notification",name="Notification")
     * @Method({{"GET","POST"}})
     */
    public function indexNotification(){
      

        return $this->render('User/Accueil/listings.html.twig');
    }

     /**
     * @Route("/Annonce1/{id}",name="Annonce1")
     * @Method({{"GET","POST"}})
     */
    public function Annonce1($id):Response{
    
        
        $user= $this->getDoctrine()->getRepository(Users::class)->findOneBy( array ('id' => $id));
      
        return $this->render('User/Accueil/Annonces1.html.twig',array('user' =>$user  ));
    } 



     /**
     * @Route("/index1/{id}",name="index1")
     * @Method({{"GET","POST"}})
     */
    public function index1($id):Response{
    
        
        $user= $this->getDoctrine()->getRepository(Users::class)->findOneBy( array ('id' => $id));

        return $this->render('User/Accueil/index1.html.twig',array('user' =>$user  ));
    } 

    /**
     * @Route("/Annonce",name="Annonce")
     * @Method({{"GET","POST"}})
     */
    public function Annonce(){
    
        
      

        return $this->render('User/Accueil/Annonces.html.twig');
    } 

     


     /**
     * @Route("/dashboard/{id}",name="dashboard_user")
     * @Method({{"GET","POST"}})
     */
    public function dashboard($id){
      
    
        
     $user= $this->getDoctrine()->getRepository(Users::class)->findOneBy( array ('id' => $id));
    
        return $this->render('DashboardUser/index.html.twig',array('user'=>$user));
    }



}
?>