<?php

namespace App\Entity\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


trait HasTimestampTrait {

  /**
   * @gedmo\Timestampable(on="create")
   * @ORM\Column(type="datetime_immutable")
   * @Groups("get","Recipe:item:get")
   */
  private $createdAt;

  /**
   * @gedmo\Timestampable(on="create")
   * @ORM\Column(type="datetime_immutable")
   * @Groups("Recipe:item:get")
   */
  private $updatedAt;

  public function getCreatedAt(): ?\DateTimeImmutable {
    return $this->createdAt;
  }

  public function setCreatedAt(\DateTimeImmutable $createdAt): self {
    $this->createdAt = $createdAt;

    return $this;
  }

  public function getUpdatedAt(): ?\DateTimeImmutable {
    return $this->updatedAt;
  }

  public function setUpdatedAt(\DateTimeImmutable $updatedAt): self {
    $this->updatedAt = $updatedAt;

    return $this;
  }
}
