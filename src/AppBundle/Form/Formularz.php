<?php

namespace AppBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\File;
class Formularz extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('title',ChoiceType::class,[
                'choices'  => [
                    'Zmiana przystanku' => "Zmiana przystanku",
                    'Zmiana godziny odjazdu autobusu' => "Godzina odjazdu",
                    'Zmiana godziny przyjazdu odjazdu' => "Godzina",
            ]])
            ->add('content',TextareaType::class,array('attr' =>array('class'=>'tresc')))
            ->add('file', FileType::class,['required' => false,'constraints'=> [new File(['maxSize'=>'1M','maxSizeMessage'=>'plik jest za duży'])]]);
            
    }
    public function configureOptions(OptionsResolver $resolver)
    {
    }
}