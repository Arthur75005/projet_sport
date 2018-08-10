<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChallengeRepository")
 */
class Challenge
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="challenges")
    */
    private $event;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Team", inversedBy="groupTeamEvents")
     */
    private $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEvent(): ?Team
    {
        return $this->event;
    }

    public function setEvent(?Team $event): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Team $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
        }

        return $this;
    }

    public function removeEvent(Team $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
        }

        return $this;
    }
}
