<?php

namespace App\Controller\Admin;

use App\Entity\Wine;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WineCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Wine::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'nom'),
            IntegerField::new('price', 'prix'),
            TextField::new('picture','photo'),
            TextEditorField::new('description','desciption'),
            AssociationField::new('color', 'couleur'),
            AssociationField::new('naming', 'appellation'),
            AssociationField::new('region', 'région'),
        ];
    }
}
