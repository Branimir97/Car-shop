<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $last_name;

    /**
     * @ORM\OneToMany(targetEntity=Vehicle::class, mappedBy="user")
     */
    private $vehicles;

    /**
     * @ORM\OneToMany(targetEntity=Inquirie::class, mappedBy="user", orphanRemoval=true)
     */
    private $inquiries;

    /**
     * @ORM\OneToMany(targetEntity=FavoriteVehicle::class, mappedBy="user")
     */
    private $favoriteVehicles;

    public function __construct()
    {
        $this->vehicles = new ArrayCollection();
        $this->inquiries = new ArrayCollection();
        $this->favoriteVehicles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * @return Collection|Vehicle[]
     */
    public function getVehicles(): Collection
    {
        return $this->vehicles;
    }

    public function addVehicle(Vehicle $vehicle): self
    {
        if (!$this->vehicles->contains($vehicle)) {
            $this->vehicles[] = $vehicle;
            $vehicle->setUser($this);
        }

        return $this;
    }

    public function removeVehicle(Vehicle $vehicle): self
    {
        if ($this->vehicles->contains($vehicle)) {
            $this->vehicles->removeElement($vehicle);
            // set the owning side to null (unless already changed)
            if ($vehicle->getUser() === $this) {
                $vehicle->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Inquirie[]
     */
    public function getInquiries(): Collection
    {
        return $this->inquiries;
    }

    public function addInquiry(Inquirie $inquiry): self
    {
        if (!$this->inquiries->contains($inquiry)) {
            $this->inquiries[] = $inquiry;
            $inquiry->setUser($this);
        }

        return $this;
    }

    public function removeInquiry(Inquirie $inquiry): self
    {
        if ($this->inquiries->contains($inquiry)) {
            $this->inquiries->removeElement($inquiry);
            // set the owning side to null (unless already changed)
            if ($inquiry->getUser() === $this) {
                $inquiry->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FavoriteVehicle[]
     */
    public function getFavoriteVehicles(): Collection
    {
        return $this->favoriteVehicles;
    }

    public function addFavoriteVehicle(FavoriteVehicle $favoriteVehicle): self
    {
        if (!$this->favoriteVehicles->contains($favoriteVehicle)) {
            $this->favoriteVehicles[] = $favoriteVehicle;
            $favoriteVehicle->setUser($this);
        }

        return $this;
    }

    public function removeFavoriteVehicle(FavoriteVehicle $favoriteVehicle): self
    {
        if ($this->favoriteVehicles->contains($favoriteVehicle)) {
            $this->favoriteVehicles->removeElement($favoriteVehicle);
            // set the owning side to null (unless already changed)
            if ($favoriteVehicle->getUser() === $this) {
                $favoriteVehicle->setUser(null);
            }
        }

        return $this;
    }
}
