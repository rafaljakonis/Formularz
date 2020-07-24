<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Post;
use AppBundle\Form\Formularz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/base.html.twig', [
        ]);
    }
    /**
     * @Route("/formularz", name="form")
     */
    public function formAction(Request $request)
    {
        $post = new Post;
        $form = $this->createForm(Formularz::class, $post);
       
        $form->handleRequest($request);
           dump($request);;die;
        if($form->isSubmitted() && $form->isValid())
        {
            $plik = $form->get('file')->getData();
            if($plik)
            {
            $unikatowa= uniqid().'.'.$plik->guessExtension();
            $plik->move($this->getParameter('pliki'),$unikatowa);
            }
            else
            {
                $unikatowa = " ";
            }
            $post ->setFile($unikatowa);
            $post ->setVision(0);
            $post = $form->getData();
         
            $eM = $this->getDoctrine()->getManager();
            $eM->persist($post);
            $eM->flush();
            
            return $this->redirectToRoute('form');
            
            
        }
        return $this->render('default/index.html.twig', ['formularz' => $form->createView()]);
    }
    /**
     * @Route("/panel_administacyjny", name="panel")
     */
    public function controlAction()
    {
        $eM = $this->getDoctrine()->getManager();
        $produkty = $eM ->getRepository('AppBundle\Entity\Post')->findAll();       
        return $this->render('default/control.html.twig',['wyniki'=>$produkty ]);
    }
    /**
     * @Route("/panel_administacyjny/zgłosznie/{id}", name="panelShowNote")
     */
    public function controlShowNoteAction($id)
    {     
        
        $eM = $this->getDoctrine()->getManager();
        $produkt= $eM->getRepository('AppBundle\Entity\Post')->find($id);
        $produkt->setVision(1);
        $eM->flush();
        return $this->render('default/note.html.twig',['zgloszenia'=>$produkt]);;            
    }
    /**
     * @Route("/panel_administacyjny/usuwanie/{id}", name="panelDel")
     */
    public function controlDelNoteAction($id)
    {
        $eM = $this->getDoctrine()->getManager();
        $produkt = $eM ->getRepository('AppBundle\Entity\Post')->find($id);   
        $eM -> remove($produkt);
        $eM -> flush();
        $produkty =$eM ->getRepository('AppBundle\Entity\Post')->findAll();
        return $this->redirectToRoute('panel');
    }



}
