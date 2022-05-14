<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Sonata\MediaBundle\Entity\BaseMedia;

#[Entity]
#[Table(name: 'media__media')]
class SonataMediaMedia extends BaseMedia
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    protected ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return (string) $this->id ?? '';
    }
}
