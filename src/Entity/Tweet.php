<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TweetRepository")
 */
class Tweet
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
    private $text;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $timestamp;

    /**
     * @ORM\Column(type="string")
     */
    private $userName;

    public function __construct(string $text, \DateTimeImmutable $timestamp, string $userName)
    {
        $this->text = $text;
        $this->timestamp = $timestamp;
        $this->userName = $userName;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getTimestamp(): \DateTimeImmutable
    {
        return $this->timestamp;
    }
}
