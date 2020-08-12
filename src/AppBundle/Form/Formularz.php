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
use AppBundle\Entity\Post;

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
            ->add('content',TextareaType::class,array('attr' =>array('class'=>'content')))
            ->add('file', FileType::class,['required'=>false,'mapped'=>false,'multiple'=>true,'attr' => ['maxlength' => 4]]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Post::class, ]);
    }
}