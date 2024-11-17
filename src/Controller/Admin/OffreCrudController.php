<?php

namespace App\Controller\Admin;

use App\Entity\Offre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OffreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Offre::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextField::new('soustitre'),
            ImageField::new("image")
                ->setBasePath('circuits/')
                ->setUploadDir('public/circuits')
               -> setUploadedFileNamePattern('[randomhash].[extension]'),
            TextField::new('ville'),
            TextField::new('prix'),
            TextField::new('newprix')
        ];
    }
    
}
