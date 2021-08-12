<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
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
    private $nameClient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mailClient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numClient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adressClient;

    /**
     * @ORM\Column(type="object")
     */
    private $imageClient;

    /**
     * @ORM\OneToMany(targetEntity=Project::class, mappedBy="client")
     */
    private $projects;

    /**
     * @ORM\OneToMany(targetEntity=Project::class, mappedBy="clients")
     */
    private $projectt;




    public function __constructClient() {
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







    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->projectt = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameClient(): ?string
    {
        return $this->nameClient;
    }

    public function setNameClient(string $nameClient): self
    {
        $this->nameClient = $nameClient;

        return $this;
    }

    public function getMailClient(): ?string
    {
        return $this->mailClient;
    }

    public function setMailClient(string $mailClient): self
    {
        $this->mailClient = $mailClient;

        return $this;
    }

    public function getNumClient(): ?string
    {
        return $this->numClient;
    }

    public function setNumClient(string $numClient): self
    {
        $this->numClient = $numClient;

        return $this;
    }

    public function getAdressClient(): ?string
    {
        return $this->adressClient;
    }

    public function setAdressClient(string $adressClient): self
    {
        $this->adressClient = $adressClient;

        return $this;
    }

    public function getImageClient()
    {
        return $this->imageClient;
    }

    public function setImageClient($imageClient): self
    {
        $this->imageClient = $imageClient;

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setClient($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getClient() === $this) {
                $project->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjectt(): Collection
    {
        return $this->projectt;
    }

    public function addProjectt(Project $projectt): self
    {
        if (!$this->projectt->contains($projectt)) {
            $this->projectt[] = $projectt;
            $projectt->setClients($this);
        }

        return $this;
    }

    public function removeProjectt(Project $projectt): self
    {
        if ($this->projectt->removeElement($projectt)) {
            // set the owning side to null (unless already changed)
            if ($projectt->getClients() === $this) {
                $projectt->setClients(null);
            }
        }

        return $this;
    }
}
