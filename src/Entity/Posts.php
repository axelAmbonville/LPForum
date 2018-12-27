<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostsRepository")
 */
class Posts
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
    private $post_content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $post_datetime;

    /**
     * @ORM\Column(type="boolean")
     */
    private $post_enabled;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $posts_author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Topics", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $posts_topic;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostContent(): ?string
    {
        return $this->post_content;
    }

    public function setPostContent(string $post_content): self
    {
        $this->post_content = $post_content;

        return $this;
    }

    public function getPostDatetime(): ?\DateTimeInterface
    {
        return $this->post_datetime;
    }

    public function setPostDatetime(\DateTimeInterface $post_datetime): self
    {
        $this->post_datetime = $post_datetime;

        return $this;
    }

    public function getPostEnabled(): ?bool
    {
        return $this->post_enabled;
    }

    public function setPostEnabled(bool $post_enabled): self
    {
        $this->post_enabled = $post_enabled;

        return $this;
    }

    public function getPostsAuthor(): ?Users
    {
        return $this->posts_author;
    }

    public function setPostsAuthor(?Users $posts_author): self
    {
        $this->posts_author = $posts_author;

        return $this;
    }

    public function getPostsTopic(): ?Topics
    {
        return $this->posts_topic;
    }

    public function setPostsTopic(?Topics $posts_topic): self
    {
        $this->posts_topic = $posts_topic;

        return $this;
    }
}
