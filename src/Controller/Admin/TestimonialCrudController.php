<?php

namespace App\Controller\Admin;

use App\Entity\Testimonial;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class TestimonialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Testimonial::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle("index", "Témoignages")
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->onlyWhenUpdating(),
            Field::new('authorName', 'Auteur du témoignage (nom complet)'),
            TextareaField::new('message', 'Témoignage de la personne'),
            Field::new('activity', 'Métier ou activité de cette personne dans la vie de tous les jours'),
        ];
    }
}
