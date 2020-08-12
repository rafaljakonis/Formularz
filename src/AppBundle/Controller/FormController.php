<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Post;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use AppBundle\Entity\Pliki;
use AppBundle\Form\Formularz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class FormController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/main.html.twig', [
        ]);
    }
    /**
     * @Route("/formularz", name="form")
     */
    public function formAction(Request $request)
    {
        $post = new Post;
        $form = $this->createForm(Formularz::class); 
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {  
  
            $plikiForm = $request->files->get('formularz')['file'];
            $dopuszczalneFormaty = ['pdf','doc','rtf','xls','ods','odt','jpg','png','jpeg'];
            if(count($plikiForm)>=4)
            {
                $this->addFlash('error', 'Dodałeś za dużo plików ( limit to 3 )');
                return $this->redirectToRoute('form');
            }
           
            if(empty($plikiForm))
            {
                $unikatowa = [" "," "," "];
            }
            else
            {
                $i = 0 ;
                $unikatowa = [" "," "," "];
                 foreach($plikiForm as $plikiFormularz)
                {
                    if( ($plikiFormularz->getSize()) >1000000)
                    {
                        $this->addFlash('error', 'Dodany plik jest za duży (limit to 1 MB)');
                        return $this->redirectToRoute('form');
                    }
                    $exte = pathinfo($plikiFormularz->getClientOriginalName());
                    if(in_array($exte['extension'],$dopuszczalneFormaty))
                    {
                    $unikatowa[$i]= uniqid().'.'.$plikiFormularz->guessExtension();
                    $plikiFormularz->move($this->getParameter('pliki'),$unikatowa[$i]);
                    $i++;
                    }
                    else
                    {
                        $this->addFlash('error', 'Wybrałeś niewłaściwe rozszczerznie pliku');
                        return $this->redirectToRoute('form'); 
                    }                 
                } 
            }
            
            $post = $form->getData();
            $post ->setVision(0);
            $post ->setPlik1($unikatowa[0]);
            $post ->setPlik2($unikatowa[1]);
            $post ->setPlik3($unikatowa[2]);     
            $eM = $this->getDoctrine()->getManager();
            $eM->persist($post);
            $eM->flush();

            $this->addFlash('success', 'Zgłoszenie zostało poprawinie dodane');
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
        try
        {  
        $eM = $this->getDoctrine()->getManager();
        $produkt = $eM ->getRepository('AppBundle\Entity\Post')->find($id);   
        $eM -> remove($produkt);
        $eM -> flush();
        $produkty =$eM ->getRepository('AppBundle\Entity\Post')->findAll();
        return $this->redirectToRoute('panel');
        }
        catch (\Exception $error)
        {
            return $this->redirectToRoute('panel'); 
        }
    }



}
