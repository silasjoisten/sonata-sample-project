<?php

namespace App\Controller;

use App\Entity\SonataMediaGallery;
use App\Entity\SonataMediaGalleryItem;
use Sonata\MediaBundle\Admin\GalleryAdmin;
use Sonata\MediaBundle\Entity\MediaManager;
use Sonata\MediaBundle\Entity\GalleryManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

final class CreateGalleryAction
{
    private MediaManager $mediaManager;
    private GalleryManager $galleryManager;
    private GalleryAdmin $galleryAdmin;

    public function __construct(
        MediaManager   $mediaManager,
        GalleryManager $galleryManager,
        GalleryAdmin   $galleryAdmin
    ) {
        $this->mediaManager = $mediaManager;
        $this->galleryManager = $galleryManager;
        $this->galleryAdmin = $galleryAdmin;
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $idx = $request->query->get('idx');
        $idx = json_decode($idx);

        /** @var SonataMediaGallery $gallery */
        $gallery = $this->galleryManager->create();
        $gallery->setName('Auto Created Gallery');
        $gallery->setEnabled(false);
        $gallery->setContext('default');

        foreach ($idx as $id) {
            $media = $this->mediaManager->find($id);

            $galleryHasMedia = new SonataMediaGalleryItem();
            $galleryHasMedia->setGallery($gallery);
            $galleryHasMedia->setMedia($media);
            $gallery->addGalleryItem($galleryHasMedia);
        }

        $this->galleryManager->save($gallery);

        return new RedirectResponse($this->galleryAdmin->generateObjectUrl('edit', $gallery));
    }
}
