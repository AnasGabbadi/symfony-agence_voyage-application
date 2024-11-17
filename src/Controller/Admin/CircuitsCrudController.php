<?php

namespace App\Controller\Admin;

use App\Entity\Circuits;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CircuitsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Circuits::class;
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
            TextField::new('ville')
        ];
    }
    
    
}
