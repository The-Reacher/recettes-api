<?php

namespace App\Entity\Traits;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;


trait HasNameTrait {

  /**
   * @ORM\Column(type="string", length=128)
   */
  private $name;

  /**
   * @gedmo\Slug(fields={"name"}, unique=true)
   * @ORM\Column(type="string", length=128, unique=true)
   * @Groups("get","Recipe:item:get")
   */
  private $slug;

  public function getName(): ?string {
    return $this->name;
  }

  public function setName(string $name): self {
    $this->name = $name;

    return $this;
  }

  public function getSlug(): ?string {
    return $this->slug;
  }

  public function setSlug(string $slug): self {
    $this->slug = $slug;

    return $this;
  }
}
