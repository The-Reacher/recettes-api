<?php

namespace App\Entity\Traits;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;


trait HasDescriptionTrait {

  /**
   * @ORM\Column(type="text", nullable=true)
   * @Groups("get","Recipe:item:get")
   */
  private $description;

  public function getDescription(): ?string {
    return $this->description;
  }

  public function setDescription(?string $description): self {
    $this->description = $description;

    return $this;
  }
}
