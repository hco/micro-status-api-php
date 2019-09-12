<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TweetRepository")
 */
class Tweet implements \JsonSerializable
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
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    private $user;

    public function __construct(string $text, \DateTimeImmutable $timestamp, User $user)
    {
        $this->text = $text;
        $this->timestamp = $timestamp;
        $this->user = $user;
    }

    public function getUsername(): string
    {
        return $this->user->getUsername();
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

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'username' => $this->getUsername(),
            'timestamp' => $this->timestamp,
        ];
    }
}
