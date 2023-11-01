<?php

namespace App\Entity\Traits;


trait HasIdTrait {
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;


  public function getId(): ?int
    {
        return $this->id;
    }
}
