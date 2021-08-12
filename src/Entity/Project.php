<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
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
    private $labelleProject;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $budgetProject;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $deadlineProject;

    /**
     * @ORM\Column(type="object")
     */
    private $logoProject;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $responsibleProject;

    /**
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="date")
     */
    private $updateAt;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="projects")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="projectt")
     */
    private $clients;



    public function __constructProject() {
        // we set up "created"+"modified"
        $this->setCreated(new \DateTime());
        if ($this->getModified() == null) {
            $this->setModified(new \DateTime());
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function updateModifiedDatetime() {
        // update the modified time
        $this->setModified(new \DateTime());
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabelleProject(): ?string
    {
        return $this->labelleProject;
    }

    public function setLabelleProject(string $labelleProject): self
    {
        $this->labelleProject = $labelleProject;

        return $this;
    }

    public function getBudgetProject(): ?string
    {
        return $this->budgetProject;
    }

    public function setBudgetProject(string $budgetProject): self
    {
        $this->budgetProject = $budgetProject;

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

    public function getDeadlineProject(): ?\DateTimeInterface
    {
        return $this->deadlineProject;
    }

    public function setDeadlineProject(\DateTimeInterface $deadlineProject): self
    {
        $this->deadlineProject = $deadlineProject;

        return $this;
    }

    public function getLogoProject()
    {
        return $this->logoProject;
    }

    public function setLogoProject($logoProject): self
    {
        $this->logoProject = $logoProject;

        return $this;
    }

    public function getResponsibleProject(): ?string
    {
        return $this->responsibleProject;
    }

    public function setResponsibleProject(string $responsibleProject): self
    {
        $this->responsibleProject = $responsibleProject;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getClients(): ?Client
    {
        return $this->clients;
    }

    public function setClients(?Client $clients): self
    {
        $this->clients = $clients;

        return $this;
    }
}
