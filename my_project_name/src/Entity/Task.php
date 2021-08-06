<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{
    private const EXECUTE = 'No';
    private const DRAFT = 'Yes';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $execute;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $executor;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="executor")
     */
    private $performer;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreate_At(): ?\DateTimeInterface
    {
        return $this->create_at;

    }

    public function setCreateAtValue()
    {
        $this->create_at = new \DateTime();

    }

    /**
     * @param \DateTimeInterface $create_at
     */
    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getExecute(): ?string
    {
        return $this->execute;
    }

    public function setExecute()
    {
        $this->execute = self::EXECUTE;
    }

    public function setDraft()
    {
        $this->execute = self::DRAFT;
    }

    /**
     * @return User|null
     */
    public function getExecutor(): ?User
    {
        return $this->executor;
    }

    /**
     * @param User|null $executor
     */
    public function setExecutor(?User $executor): self
    {
        $this->executor = $executor;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getPerformer(): ?User
    {
        return $this->performer;
    }

    /**
     * @param User|null $performer
     */
    public function setPerformer(?User $performer): self
    {
        $this->performer = $performer;

        return $this;
    }
}
