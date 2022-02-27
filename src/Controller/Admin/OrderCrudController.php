<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;

class OrderCrudController extends AbstractCrudController
{
    private $entityManager;
    private $crudUrlGenerator;

    public function __construct(EntityManagerInterface $entityManager, CrudUrlGenerator $crudUrlGenerator)
    {
        $this->entityManager = $entityManager;
        $this->crudUrlGenerator = $crudUrlGenerator;
    }

    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $updatePreparation = Action::new('updatePreparation', 'Preparation En Cours','fa fa-box-open')->linkToCrudAction('updatePreparation');
        $updateDelivery = Action::new('updateDelivery', 'Livraison En Cours', 'fa fa-truck-loading')->linkToCrudAction('updateDelivery');
        return $actions
            ->add('index', 'detail')
            ->add('detail', $updatePreparation)
            ->add('detail', $updateDelivery);
    }
    
    public function updatePreparation(AdminContext $context)
    {
        $order = $context->getEntity()->getInstance();
        $order->setState(2);
        $this->entityManager->flush();

        $this->addFlash('notice', "<span style ='color:green;'><strong> Commande N° ". $order->getReference() ." est maintenant <u>en cours de préparation</u>.</strong></span>");

        $url = $this->get(AdminUrlGenerator::class);

        // $mail = new Mail();
        // $mail->send();

        return $this->redirect($url
            ->setController(OrderCrudController::class)
            ->setAction('detail')
            ->generateUrl()
        );
    }

    public function updateDelivery(AdminContext $context)
    {
        $order = $context->getEntity()->getInstance();
        $order->setState(3);
        $this->entityManager->flush();

        $this->addFlash('notice', "<span style ='color:green;'><strong> Commande N° ". $order->getReference() ." est maintenant <u>en cours de livraison</u>.</strong></span>");

        $url = $this->get(AdminUrlGenerator::class);

        // $mail = new Mail();
        // $mail->send();

        return $this->redirect($url
            ->setController(OrderCrudController::class)
            ->setAction('index')
            ->generateUrl()
        );
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            DateTimeField::new('createdAt', 'Passée Le'),
            TextField::new('user.fullname', 'Client')->hideOnIndex(),
            TextEditorField::new('delivery', 'Adresse de livraison')->formatValue(function($value){return $value;})->onlyOnDetail(),
            MoneyField::new('total', 'Sous-Total')->setCurrency('EUR'),
            MoneyField::new('carrierPrice', 'Frais de Port')->setCurrency('EUR')->hideOnDetail(),
            TextField::new('carrierName', 'Livraison'),
            MoneyField::new('final', 'Total')->setCurrency('EUR'),
            ChoiceField::new('state', 'Etat')->setChoices([
                'Non Validée' => 0,
                'Payée' => 1,
                'En Preparation' => 2,
                'Envoi En Cours' =>3,
                'Receptionnée' =>4,
            ]),
            ArrayField::new('orderDetails', 'Produits Achetés')->hideOnIndex(),
        ];
    }
    
}
