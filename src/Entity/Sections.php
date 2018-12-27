<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SectionsRepository")
 */
class Sections
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sec_title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sec_subtitle;

    /**
     * @ORM\Column(type="datetime")
     */
    private $sec_datetime;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sec_enabled;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Categories", mappedBy="cat_section")
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSecTitle(): ?string
    {
        return $this->sec_title;
    }

    public function setSecTitle(string $sec_title): self
    {
        $this->sec_title = $sec_title;

        return $this;
    }

    public function getSecSubtitle(): ?string
    {
        return $this->sec_subtitle;
    }

    public function setSecSubtitle(string $sec_subtitle): self
    {
        $this->sec_subtitle = $sec_subtitle;

        return $this;
    }

    public function getSecDatetime(): ?\DateTimeInterface
    {
        return $this->sec_datetime;
    }

    public function setSecDatetime(\DateTimeInterface $sec_datetime): self
    {
        $this->sec_datetime = $sec_datetime;

        return $this;
    }

    public function getSecEnabled(): ?bool
    {
        return $this->sec_enabled;
    }

    public function setSecEnabled(bool $sec_enabled): self
    {
        $this->sec_enabled = $sec_enabled;

        return $this;
    }

    /**
     * @return Collection|Categories[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setCatSection($this);
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            // set the owning side to null (unless already changed)
            if ($category->getCatSection() === $this) {
                $category->setCatSection(null);
            }
        }

        return $this;
    }
}
