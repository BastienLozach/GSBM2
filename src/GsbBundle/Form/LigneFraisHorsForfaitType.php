<?php

namespace GsbBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LigneFraisHorsForfaitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('dateFrais')
            ->add('montant')
            //->add('etat')
            //->add('ficheFrais')
            ->add("Valider", "submit")
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GsbBundle\Entity\LigneFraisHorsForfait'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gsbbundle_lignefraishorsforfait';
    }
}
