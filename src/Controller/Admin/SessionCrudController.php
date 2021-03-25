<?php

namespace App\Controller\Admin;

use App\Entity\Session;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class SessionCrudController extends AbstractCrudController
{
    private $mailer;

    public function __construct(MailerInterface $mailer) {
        $this->mailer = $mailer;
    }

    public static function getEntityFqcn(): string
    {
        return Session::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle("index", "Ateliers en ligne")
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->onlyWhenUpdating(),
            Field::new('title', 'Titre de l\'atelier'),
            Field::new('description'),
            AssociationField::new('state', 'Disponibilité'),
            AssociationField::new('participants', 'Participants'),
            DatetimeField::new('beginsAt', "Date / heure début"),
            DatetimeField::new('endsAt', "Date / heure fin"),
            UrlField::new('link', "Lien de la session en ligne"),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $sendLink = Action::new('sendLink', 'Envoyer lien', 'fa fa-paper-plane')
            ->linkToCrudAction('sendLink');
        
        return $actions
            ->add(Crud::PAGE_INDEX, $sendLink);
    }

    public function sendLink(AdminContext $context)
    {
        $session = $context->getEntity()->getInstance();
        $participants = $session->getParticipants();

        foreach($participants as $participant) {
            $email = (new TemplatedEmail())
                ->to($participant->getEmail())
                ->subject("Lien de l'atelier en ligne du " . $session->getBeginsAt()->format('d/m/Y') . " à " . $session->getBeginsAt()->format("H:i"))
                ->htmlTemplate('services/session_link_email.html.twig')
                ->context([
                    "user" => $participant,
                    "session"=> $session
                ])
            ;

            $this->mailer->send($email);

            return $this->redirectToRoute("admin");
        }
    }
}
