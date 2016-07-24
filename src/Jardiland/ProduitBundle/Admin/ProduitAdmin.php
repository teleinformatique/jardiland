<?php
namespace Jardiland\ProduitBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Jardiland\ProduitBundle\Form\ImageType;
use Jardiland\ProduitBundle\Entity\UploadedFileTransformer;

class ProduitAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
         
        $formMapper
            ->add('nom', 'text', array('label' => 'Nom du produit'))
            
            ->add('description', 'textarea', array('attr' => array('class' => 'ckeditor'))) //if no type is specified, SonataAdminBundle tries to guess it
            ->add('prix') //if no type is specified, SonataAdminBundle tries to guess it
           
            ->add('marque') //if no type is specified, SonataAdminBundle tries to guess it
            ->add('file','file')
            ->add('categorie') //if no type is specified, SonataAdminBundle tries to guess it
            
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom')
            ->add('categorie')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            
            ->add('marque')
        ;
    }
    
   

}
