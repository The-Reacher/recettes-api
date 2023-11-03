<?php

namespace App\Entity\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;


trait HasPriorityTrait {

  /**
   * @ORM\Column(type="integer")
   * @Groups("get","Recipe:item:get")
   */
  private $priority;


  public function getPriority(): ?int {
    return $this->priority;
  }

  public function setPriority(int $priority): self {
    $this->priority = $priority;

    return $this;
  }
}
