<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brand;

    /**
     * @ORM\Column(type="integer")
     */
    private $currentPrice;

    /**
     * @ORM\Column(type="integer")
     */
    private $formerPrice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $currentCondition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $age;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity=appartment::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $appartment;

    /**
     * @ORM\OneToOne(targetEntity=Review::class, mappedBy="product", cascade={"persist", "remove"})
     */
    private $review;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getCurrentPrice(): ?int
    {
        return $this->currentPrice;
    }

    public function setCurrentPrice(int $currentPrice): self
    {
        $this->currentPrice = $currentPrice;

        return $this;
    }

    public function getFormerPrice(): ?int
    {
        return $this->formerPrice;
    }

    public function setFormerPrice(int $formerPrice): self
    {
        $this->formerPrice = $formerPrice;

        return $this;
    }

    public function getCurrentCondition(): ?string
    {
        return $this->currentCondition;
    }

    public function setCurrentCondition(string $currentCondition): self
    {
        $this->currentCondition = $currentCondition;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getAppartment(): ?appartment
    {
        return $this->appartment;
    }

    public function setAppartment(?appartment $appartment): self
    {
        $this->appartment = $appartment;

        return $this;
    }

    public function getReview(): ?Review
    {
        return $this->review;
    }

    public function setReview(Review $review): self
    {
        // set the owning side of the relation if necessary
        if ($review->getProduct() !== $this) {
            $review->setProduct($this);
        }

        $this->review = $review;

        return $this;
    }
}
