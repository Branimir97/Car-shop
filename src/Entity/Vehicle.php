<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehicleRepository::class)
 */
class Vehicle
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
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mark;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\Column(type="integer")
     */
    private $manufactureYear;

    /**
     * @ORM\Column(type="integer")
     */
    private $modelYear;

    /**
     * @ORM\Column(type="float")
     */
    private $kilometers;

    /**
     * @ORM\Column(type="integer")
     */
    private $power;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gearbox;

    /**
     * @ORM\Column(type="integer")
     */
    private $gears;

    /**
     * @ORM\Column(type="float")
     */
    private $consumption;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="vehicles")
     */
    private $user;

    /**
     * @ORM\Column(type="boolean", options={"default":1})
     */
    private $visibility=1;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="vehicle", orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=Inquirie::class, mappedBy="vehicle", orphanRemoval=true)
     */
    private $inquiries;

    /**
     * @ORM\OneToMany(targetEntity=FavoriteVehicle::class, mappedBy="vehicle", orphanRemoval=true)
     */
    private $favoriteVehicles;

    /**
     * @ORM\OneToMany(targetEntity=AdditionalEquipment::class, mappedBy="vehicle", orphanRemoval=true)
     */
    private $additionalEquipment;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->inquiries = new ArrayCollection();
        $this->favoriteVehicles = new ArrayCollection();
        $this->additionalEquipment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getManufactureYear(): ?int
    {
        return $this->manufactureYear;
    }

    public function setManufactureYear(int $manufactureYear): self
    {
        $this->manufactureYear = $manufactureYear;

        return $this;
    }

    public function getModelYear(): ?int
    {
        return $this->modelYear;
    }

    public function setModelYear(int $modelYear): self
    {
        $this->modelYear = $modelYear;

        return $this;
    }

    public function getKilometers(): ?float
    {
        return $this->kilometers;
    }

    public function setKilometers(float $kilometers): self
    {
        $this->kilometers = $kilometers;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(int $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getGearbox(): ?string
    {
        return $this->gearbox;
    }

    public function setGearbox(string $gearbox): self
    {
        $this->gearbox = $gearbox;

        return $this;
    }

    public function getGears(): ?int
    {
        return $this->gears;
    }

    public function setGears(int $gears): self
    {
        $this->gears = $gears;

        return $this;
    }

    public function getConsumption(): ?float
    {
        return $this->consumption;
    }

    public function setConsumption(float $consumption): self
    {
        $this->consumption = $consumption;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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

    public function getVisibility(): ?bool
    {
        return $this->visibility;
    }

    public function setVisibility(bool $visibility): self
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setVehicle($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getVehicle() === $this) {
                $image->setVehicle(null);
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
            $inquiry->setVehicle($this);
        }

        return $this;
    }

    public function removeInquiry(Inquirie $inquiry): self
    {
        if ($this->inquiries->contains($inquiry)) {
            $this->inquiries->removeElement($inquiry);
            // set the owning side to null (unless already changed)
            if ($inquiry->getVehicle() === $this) {
                $inquiry->setVehicle(null);
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
            $favoriteVehicle->setVehicle($this);
        }

        return $this;
    }

    public function removeFavoriteVehicle(FavoriteVehicle $favoriteVehicle): self
    {
        if ($this->favoriteVehicles->contains($favoriteVehicle)) {
            $this->favoriteVehicles->removeElement($favoriteVehicle);
            // set the owning side to null (unless already changed)
            if ($favoriteVehicle->getVehicle() === $this) {
                $favoriteVehicle->setVehicle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AdditionalEquipment[]
     */
    public function getAdditionalEquipment(): Collection
    {
        return $this->additionalEquipment;
    }

    public function addAdditionalEquipment(AdditionalEquipment $additionalEquipment): self
    {
        if (!$this->additionalEquipment->contains($additionalEquipment)) {
            $this->additionalEquipment[] = $additionalEquipment;
            $additionalEquipment->setVehicle($this);
        }

        return $this;
    }

    public function removeAdditionalEquipment(AdditionalEquipment $additionalEquipment): self
    {
        if ($this->additionalEquipment->contains($additionalEquipment)) {
            $this->additionalEquipment->removeElement($additionalEquipment);
            // set the owning side to null (unless already changed)
            if ($additionalEquipment->getVehicle() === $this) {
                $additionalEquipment->setVehicle(null);
            }
        }

        return $this;
    }
}
