<?php

namespace App\Controller\Admin;

use App\Entity\CauseType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class CauseTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CauseType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle("index", "Types de raisons pour rendez-vous")
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->onlyWhenUpdating(),
            Field::new('nameType', 'Type de raison'),
            Field::new('description', 'Description de ce type de raison'),
        ];
    }

}
