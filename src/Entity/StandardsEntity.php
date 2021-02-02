<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="standards")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\StandardsRepository")
 */
class StandardsEntity
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="CompliancesEntity")
     * @ORM\JoinColumn(name="compliance_id", referencedColumnName="id")
     */
    private int $compliance;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private string $code;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private string $desc;

    /**
     * @ORM\Column(type="boolean", options={"default": "0"})
     */
    private string $status;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDesc(): string
    {
        return $this->desc;
    }

    public function setDesc(string $desc): self
    {
        $this->desc = $desc;

        return $this;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}