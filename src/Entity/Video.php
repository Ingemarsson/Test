<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
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
    private $video_source;

    /**
     * @ORM\Column(type="text")
     */
    private $video_title;

    /**
     * @ORM\Column(type="text")
     */
    private $video_description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $video_preview;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $user_ip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_agent;

    /**
     * @ORM\Column(type="datetime")
     */
    private $time;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideoSource(): ?string
    {
        return $this->video_source;
    }

    public function setVideoSource(string $video_source): self
    {
        $this->video_source = $video_source;

        return $this;
    }

    public function getVideoTitle(): ?string
    {
        return $this->video_title;
    }

    public function setVideoTitle(string $video_title): self
    {
        $this->video_title = $video_title;

        return $this;
    }

    public function getVideoDescription(): ?string
    {
            return $this->video_description;
    }

    public function setVideoDescription(string $video_description): self
    {
        $this->video_description = $video_description;

        return $this;
    }

    public function getVideoPreview(): ?string
    {
            return $this->video_preview;
    }

    public function setVideoPreview(string $video_preview): self
    {
        $this->video_preview = $video_preview;

        return $this;
    }

    public function getUserIp(): ?string
    {
        return $this->user_ip;
    }

    public function setUserIp(string $user_ip): self
    {
        $this->user_ip = $user_ip;

        return $this;
    }

    public function getUserAgent(): ?string
    {
        return $this->user_agent;
    }

    public function setUserAgent(string $user_agent): self
    {
        $this->user_agent = $user_agent;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
