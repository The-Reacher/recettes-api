<?php

namespace App\Entity\Traits;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;


trait HasIdTrait {
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   * @Groups("get","Recipe:item:get")
   */
  private $id;


  public function getId(): ?int
    {
        return $this->id;
    }
}
