<?php

namespace App\Controller\Admin;

use App\Entity\Borrowing;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BorrowingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Borrowing::class;
    }
    public function configureActions(Actions $actions): Actions { return $actions ->add('index','detail'); } 

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
