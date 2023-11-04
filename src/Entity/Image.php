<?php

namespace App\Entity;

use App\Entity\Traits\HasDescriptionTrait;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasPriorityTrait;
use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Traits\HasTimestampTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @ApiResource(
 *      itemOperations={"get", "delete"})
 */
class Image {

    use HasIdTrait;
    use HasDescriptionTrait;
    use HasPriorityTrait;
    use HasTimestampTrait;

    /**
     * 
     * @Vich\UploadableField(mapping="images", fileNameProperty="path", size="size")
     * 
     * @var File|null
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get")
     */
    private $path;

    /**
     * @ORM\Column(type="integer")
     * @Groups("get")
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

    /**
     * @ORM\ManyToOne(targetEntity=Step::class, inversedBy="images")
     */
    private $step;

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $file
     */
    public function setFile(?File $file = null): void {
        $this->file = $file;
        if (null !== $file) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getFile(): ?File {
        return $this->file;
    }

    public function getPath(): ?string {
        return $this->path;
    }

    public function setPath(string $path): self {
        $this->path = $path;

        return $this;
    }

    public function getSize(): ?float {
        return $this->size;
    }

    public function setSize(float $size): self {
        $this->size = $size;

        return $this;
    }

    public function getRecipe(): ?Recipe {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self {
        $this->recipe = $recipe;

        return $this;
    }

    public function getStep(): ?Step {
        return $this->step;
    }

    public function setStep(?Step $step): self {
        $this->step = $step;

        return $this;
    }
}
