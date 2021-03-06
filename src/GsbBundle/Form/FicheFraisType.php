<?php

namespace GsbBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use GsbBundle\Entity\LigneFraisForfait ;

class FicheFraisType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('mois')
            ->add('annee')
            ->add('nbJustificatif')
            ->add('montantValide')

            //->add('dateModif')
            //->add('etat')
            //->add('visiteur')
            ->add('valider', 'submit');
       
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'GsbBundle\Entity\FicheFrais'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gsbbundle_fichefrais';
    }

}
