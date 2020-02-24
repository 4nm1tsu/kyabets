<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Validator\Constraints as MyAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("username")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @MyAssert\StudentNumber
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nickname;

    /**
     * @ORM\Column(type="integer")
     */
    private $contribution;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Badge", mappedBy="user")
     */
    private $badges;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bbs", mappedBy="user")
     */
    private $bbs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reply", mappedBy="user")
     */
    private $replies;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getContribution(): ?int
    {
        return $this->contribution;
    }

    public function setContribution(int $contribution): self
    {
        $this->contribution = $contribution;

        return $this;
    }

    public function __construct()
    {
        $this->isActive = true;
        $this->contribution = 5;
        $this->badges = new ArrayCollection();
        $this->bbs = new ArrayCollection();
        $this->replies = new ArrayCollection();
    }

    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        if ($this->username === '4617016') {
            return array('ROLE_ADMIN');
        } else {
            return array('ROLE_USER');
        }
    }

    public function eraseCredentials()
    {

    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
            $this->email,
            $this->nickname,
            $this->contribution,
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
            $this->email,
            $this->nickname,
            $this->contribution,
        ) = unserialize($serialized, array('allowed_classes'
        => false));
    }

    /**
     * @return Collection|Badge[]
     */
    public function getBadges(): Collection
    {
        return $this->badges;
    }

    public function addBadge(Badge $badge): self
    {
        if (!$this->badges->contains($badge)) {
            $this->badges[] = $badge;
            $badge->setUser($this);
        }

        return $this;
    }

    public function removeBadge(Badge $badge): self
    {
        if ($this->badges->contains($badge)) {
            $this->badges->removeElement($badge);
            // set the owning side to null (unless already changed)
            if ($badge->getUser() === $this) {
                $badge->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bbs[]
     */
    public function getBbs(): Collection
    {
        return $this->bbs;
    }

    public function addBb(Bbs $bb): self
    {
        if (!$this->bbs->contains($bb)) {
            $this->bbs[] = $bb;
            $bb->setUser($this);
        }

        return $this;
    }

    public function removeBb(Bbs $bb): self
    {
        if ($this->bbs->contains($bb)) {
            $this->bbs->removeElement($bb);
            // set the owning side to null (unless already changed)
            if ($bb->getUser() === $this) {
                $bb->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reply[]
     */
    public function getReplies(): Collection
    {
        return $this->replies;
    }

    public function addReply(Reply $reply): self
    {
        if (!$this->replies->contains($reply)) {
            $this->replies[] = $reply;
            $reply->setUser($this);
        }

        return $this;
    }

    public function removeReply(Reply $reply): self
    {
        if ($this->replies->contains($reply)) {
            $this->replies->removeElement($reply);
            // set the owning side to null (unless already changed)
            if ($reply->getUser() === $this) {
                $reply->setUser(null);
            }
        }

        return $this;
    }
}
