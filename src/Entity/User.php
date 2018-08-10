<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_de_naissance;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $departement;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $mdp;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Team", mappedBy="user")
     */
    private $teams;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Team", mappedBy="users")
     */
    private $groupTeams;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="user")
     */
    private $events;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Event", mappedBy="users")
     */
    private $groupEvents;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->groupeTeams = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->groupEvents = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->setUser($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            // set the owning side to null (unless already changed)
            if ($team->getUser() === $this) {
                $team->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getGroupTeams(): Collection
    {
        return $this->groupTeams;
    }

    public function addGroupTeam(Team $groupTeam): self
    {
        if (!$this->groupTeams->contains($groupTeam)) {
            $this->groupTeams[] = $groupTeam;
            $groupTeam->addUser($this);
        }

        return $this;
    }

    public function removeGroupTeam(Team $groupTeam): self
    {
        if ($this->groupTeams->contains($groupTeam)) {
            $this->groupTeams->removeElement($groupTeam);
            $groupTeam->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setUser($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getUser() === $this) {
                $event->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getGroupEvents(): Collection
    {
        return $this->groupEvents;
    }

    public function addGroupEvent(Event $groupEvent): self
    {
        if (!$this->groupEvents->contains($groupEvent)) {
            $this->groupEvents[] = $groupEvent;
            $groupEvent->addUser($this);
        }

        return $this;
    }

    public function removeGroupEvent(Event $groupEvent): self
    {
        if ($this->groupEvents->contains($groupEvent)) {
            $this->groupEvents->removeElement($groupEvent);
            $groupEvent->removeUser($this);
        }

        return $this;
    }
}
