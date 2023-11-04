<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait HasPriorityTrait
{
    /**
     * @ORM\Column(type="integer")
     *
     * @Groups("get","Recipe:item:get")
     */
    private int $priority;

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }
}
