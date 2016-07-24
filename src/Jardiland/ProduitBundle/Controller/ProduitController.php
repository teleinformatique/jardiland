<?php

namespace Jardiland\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jardiland\ProduitBundle\Entity\Categorie as Categorie;
use Jardiland\ProduitBundle\Entity\Produit as Produit;
use \Symfony\Component\HttpFoundation\Request as Request;

class ProduitController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('JardilandProduitBundle:Produit')->getLastProduit();
        return $this->render('JardilandProduitBundle:Produit:index.html.twig',array('produits'=>$produits));
    }

    public function voirAction(Produit $produit)
    {
       $em = $this->getDoctrine()->getManager();
       $produit = $em->getRepository('JardilandProduitBundle:Produit')->find($produit);
       
        $em    = $this->get('doctrine.orm.entity_manager');
       $dql   = "SELECT p FROM JardilandProduitBundle:Produit p WHERE  p.categorie = :categorie";
       $query = $em->createQuery($dql)
                   ->setParameter('categorie', $produit->getCategorie());
       $produits = $this->produitByCat($produit->getCategorie());
       //$produits = $em->getRepository('JardilandProduitBundle:Produit')->findByCategorie($produit->getCategorie());
       
       
       return $this->render('JardilandProduitBundle:Produit:detail.html.twig',
               array(
                   'produit'=>$produit,
                   'produits'=>$produits
               )
               );  
    }

    public function byCategorieAction(Categorie $categorie)
    {
       
               
        $pagination = $this->produitByCat($categorie);
        return $this->render('JardilandProduitBundle:Produit:byCategorie.html.twig', 
                              array('pagination' => $pagination,
                                  'categorie' => $categorie->getLibelle()
                                  )
                );
    }
    
    public function rechercheAction(Request $request) {
        $termes = "";
        if($request->getMethod() == 'POST'){
            
            $termes = $request->get('termes');
            //var_dump($donnees);die;
             $em    = $this->get('doctrine.orm.entity_manager');
            $dql   = "SELECT p FROM JardilandProduitBundle:Produit p WHERE  p.marque LIKE :termes ";
            $query = $em->createQuery($dql)
                   ->setParameter('termes', $termes);

       $paginator  = $this->get('knp_paginator');
       $pagination = $paginator->paginate(
       $query,
       $this->get('request')->query->get('page', 1)/*page number*/,
        10/*limit per page*/);
        }
        //var_dump($pagination);die;
        
        return $this->render('JardilandProduitBundle:Produit:recherche.html.twig',
                array(
                    'pagination'=>$pagination,
                    'termes'=>$termes
                )
                );
    }
    
    public function contactAction(Request $request) {
        $termes = "";
        if($request->getMethod() == 'POST'){
            
            $nom  = $request->get('nom');
            $telephone = $request->get('telephone');
            $email = $request->get('email');
            $message = $request->get('message');
            $mes = \Swift_Message::newInstance()
                        ->setSubject('Contact Jardiland')
                        ->setFrom($email)
                        ->setTo('jardiland.senegal@gmail.com')
                        ->setBody($this->renderView('JardilandProduitBundle:Produit:email.txt.twig', 
                                  array(
                                      'nom'=>$nom,
                                      'telephone'=>$telephone,
                                      'message'=>$message,
                                      'email' => $email
                                  )
                                ))
                    ;
                    $this->get('mailer')->send($mes);
        return $this->redirect($this->generateUrl('email_envoye'));
        }
        //var_dump($pagination);die;
        
        return $this->redirect($this->generateUrl('jardiland_contact'));
    }
    
    private function produitByCat(Categorie $categorie) {
        
        $em    = $this->get('doctrine.orm.entity_manager');
       $dql   = "SELECT p FROM JardilandProduitBundle:Produit p WHERE  p.categorie = :categorie ORDER BY p.id DESC";
       $query = $em->createQuery($dql)
                   ->setParameter('categorie', $categorie);

       $paginator  = $this->get('knp_paginator');
       $pagination = $paginator->paginate(
       $query,
       $this->get('request')->query->get('page', 1)/*page number*/,
        12/*limit per page*/);
       
return $pagination;
        
    }

}
