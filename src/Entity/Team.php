<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=125)
     */
    private $name_team;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $avatar;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="teams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="groupeTeams")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Challenge", mappedBy="event")
     */
    private $challenges;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Challenge", mappedBy="events")
     */
    private $groupTeamEvents;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->challenges = new ArrayCollection();
        $this->groupTeamEvents = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName_Team(): ?string
    {
        return $this->name_team;
    }

    public function setName_Team(string $name_team): self
    {
        $this->name_team = $name_team;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }

        return $this;
    }

    /**
     * @return Collection|Challenge[]
     */
    public function getChallenges(): Collection
    {
        return $this->challenges;
    }

    public function addChallenge(Challenge $challenge): self
    {
        if (!$this->challenges->contains($challenge)) {
            $this->challenges[] = $challenge;
            $challenge->setEvent($this);
        }

        return $this;
    }

    public function removeChallenge(Challenge $challenge): self
    {
        if ($this->challenges->contains($challenge)) {
            $this->challenges->removeElement($challenge);
            // set the owning side to null (unless already changed)
            if ($challenge->getEvent() === $this) {
                $challenge->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Challenge[]
     */
    public function getGroupTeamEvents(): Collection
    {
        return $this->groupTeamEvents;
    }

    public function addGroupTeamEvent(Challenge $groupTeamEvent): self
    {
        if (!$this->groupTeamEvents->contains($groupTeamEvent)) {
            $this->groupTeamEvents[] = $groupTeamEvent;
            $groupTeamEvent->addEvent($this);
        }

        return $this;
    }

    public function removeGroupTeamEvent(Challenge $groupTeamEvent): self
    {
        if ($this->groupTeamEvents->contains($groupTeamEvent)) {
            $this->groupTeamEvents->removeElement($groupTeamEvent);
            $groupTeamEvent->removeEvent($this);
        }

        return $this;
    }
}
