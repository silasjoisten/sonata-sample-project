<?php

declare(strict_types=1);

namespace App\Admin\Extension;

use App\Controller\CreateGalleryAction;
use Sonata\AdminBundle\Admin\AbstractAdminExtension;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\RouteCollectionInterface;

final class MediaAddRouteExtension extends AbstractAdminExtension
{
    public function configureRoutes(AdminInterface $admin, RouteCollectionInterface $collection): void
    {
        $collection->add('create_gallery', 'multi-upload/create-gallery', [
            '_controller' => CreateGalleryAction::class,
        ]);
    }
}
