<?php

namespace App\Controller\Admin;

use App\Entity\Naming;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NamingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Naming::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'nom'),
        ];
    }
}
