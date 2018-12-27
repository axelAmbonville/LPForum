<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TopicsRepository")
 */
class Topics
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
    private $topic_title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $topic_content;

    /**
     * @ORM\Column(type="boolean")
     */
    private $topic_solved;

    /**
     * @ORM\Column(type="datetime")
     */
    private $topic_datetime;

    /**
     * @ORM\Column(type="boolean")
     */
    private $topic_enabled;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Posts", mappedBy="posts_topic")
     */
    private $posts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="topics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $topics_cat;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTopicTitle(): ?string
    {
        return $this->topic_title;
    }

    public function setTopicTitle(string $topic_title): self
    {
        $this->topic_title = $topic_title;

        return $this;
    }

    public function getTopicContent(): ?string
    {
        return $this->topic_content;
    }

    public function setTopicContent(string $topic_content): self
    {
        $this->topic_content = $topic_content;

        return $this;
    }

    public function getTopicSolved(): ?bool
    {
        return $this->topic_solved;
    }

    public function setTopicSolved(bool $topic_solved): self
    {
        $this->topic_solved = $topic_solved;

        return $this;
    }

    public function getTopicDatetime(): ?\DateTimeInterface
    {
        return $this->topic_datetime;
    }

    public function setTopicDatetime(\DateTimeInterface $topic_datetime): self
    {
        $this->topic_datetime = $topic_datetime;

        return $this;
    }

    public function getTopicEnabled(): ?bool
    {
        return $this->topic_enabled;
    }

    public function setTopicEnabled(bool $topic_enabled): self
    {
        $this->topic_enabled = $topic_enabled;

        return $this;
    }

    /**
     * @return Collection|Posts[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Posts $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setPostsTopic($this);
        }

        return $this;
    }

    public function removePost(Posts $post): self
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
            // set the owning side to null (unless already changed)
            if ($post->getPostsTopic() === $this) {
                $post->setPostsTopic(null);
            }
        }

        return $this;
    }

    public function getTopicsCat(): ?Categories
    {
        return $this->topics_cat;
    }

    public function setTopicsCat(?Categories $topics_cat): self
    {
        $this->topics_cat = $topics_cat;

        return $this;
    }
}
