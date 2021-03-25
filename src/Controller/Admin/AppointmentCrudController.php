<?php

namespace App\Controller\Admin;

use App\Entity\Appointment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class AppointmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Appointment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle("index", "Rendez-vous")
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->onlyWhenUpdating(),
            DateTimeField::new('date'),
            AssociationField::new('state', 'Disponibilité'),
            EmailField::new('user.email', 'Email de la réservation')->onlyOnIndex(),
            Field::new('user.firstName', 'Prénom')->onlyOnIndex(),
            Field::new('user.lastName', 'Nom')->onlyOnIndex(),
            Field::new('causeType.nameType', 'Type de raison')->onlyOnIndex(),
            Field::new('completeCause', 'Raison complète du RDV'),
            Field::new('participants', 'Nombre de participants'),
        ];
    }
}
