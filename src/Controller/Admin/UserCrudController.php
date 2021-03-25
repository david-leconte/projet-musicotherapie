<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle("index", "Utilisateurs enregistrés")
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->onlyWhenUpdating(),
            EmailField::new('email'),
            Field::new('firstName', 'Prénom'),
            Field::new('lastName', 'Nom'),
            AssociationField::new('appointments', 'Rendez-vous pris'),
            AssociationField::new('sessions', 'Sessions participant'),
            BooleanField::new('verified', 'Compte vérifié'),
            ArrayField::new('roles', 'Accès sécurité'),
        ];
    }
}
