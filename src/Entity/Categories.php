<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 */
class Categories
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
    private $cat_title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cat_subtitle;

    /**
     * @ORM\Column(type="datetime")
     */
    private $cat_datetime;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cat_enabled;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Topics", mappedBy="topics_cat")
     */
    private $topics;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sections", inversedBy="categories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cat_section;

    public function __construct()
    {
        $this->topics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatTitle(): ?string
    {
        return $this->cat_title;
    }

    public function setCatTitle(string $cat_title): self
    {
        $this->cat_title = $cat_title;

        return $this;
    }

    public function getCatSubtitle(): ?string
    {
        return $this->cat_subtitle;
    }

    public function setCatSubtitle(string $cat_subtitle): self
    {
        $this->cat_subtitle = $cat_subtitle;

        return $this;
    }

    public function getCatDatetime(): ?\DateTimeInterface
    {
        return $this->cat_datetime;
    }

    public function setCatDatetime(\DateTimeInterface $cat_datetime): self
    {
        $this->cat_datetime = $cat_datetime;

        return $this;
    }

    public function getCatEnabled(): ?bool
    {
        return $this->cat_enabled;
    }

    public function setCatEnabled(bool $cat_enabled): self
    {
        $this->cat_enabled = $cat_enabled;

        return $this;
    }

    /**
     * @return Collection|Topics[]
     */
    public function getTopics(): Collection
    {
        return $this->topics;
    }

    public function addTopic(Topics $topic): self
    {
        if (!$this->topics->contains($topic)) {
            $this->topics[] = $topic;
            $topic->setTopicsCat($this);
        }

        return $this;
    }

    public function removeTopic(Topics $topic): self
    {
        if ($this->topics->contains($topic)) {
            $this->topics->removeElement($topic);
            // set the owning side to null (unless already changed)
            if ($topic->getTopicsCat() === $this) {
                $topic->setTopicsCat(null);
            }
        }

        return $this;
    }

    public function getCatSection(): ?Sections
    {
        return $this->cat_section;
    }

    public function setCatSection(?Sections $cat_section): self
    {
        $this->cat_section = $cat_section;

        return $this;
    }
}
