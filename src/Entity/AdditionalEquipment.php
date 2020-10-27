<?php

namespace App\Entity;

use App\Repository\AdditionalEquipmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdditionalEquipmentRepository::class)
 */
class AdditionalEquipment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $abs;

    /**
     * @ORM\Column(type="boolean")
     */
    private $esp;

    /**
     * @ORM\Column(type="boolean")
     */
    private $remoteLocking;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isofix;

    /**
     * @ORM\Column(type="boolean")
     */
    private $engineImmobilizer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $startStop;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hac;

    /**
     * @ORM\Column(type="boolean")
     */
    private $rainSensors;

    /**
     * @ORM\Column(type="boolean")
     */
    private $lightSensors;

    /**
     * @ORM\Column(type="boolean")
     */
    private $alarm;

    /**
     * @ORM\Column(type="boolean")
     */
    private $multifunctionalSteeringWheel;

    /**
     * @ORM\Column(type="boolean")
     */
    private $parkSensors;

    /**
     * @ORM\Column(type="boolean")
     */
    private $alloyWheels;

    /**
     * @ORM\Column(type="boolean")
     */
    private $clima;

    /**
     * @ORM\Column(type="boolean")
     */
    private $thirdStopLight;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cruiseControl;

    /**
     * @ORM\Column(type="boolean")
     */
    private $electricWindowLiftersFront;

    /**
     * @ORM\Column(type="boolean")
     */
    private $electricWindowLiftersRear;

    /**
     * @ORM\Column(type="boolean")
     */
    private $electricFoldingMirrors;

    /**
     * @ORM\Column(type="boolean")
     */
    private $tintedGlass;

    /**
     * @ORM\Column(type="boolean")
     */
    private $fogLights;

    /**
     * @ORM\Column(type="boolean")
     */
    private $roofWindow;

    /**
     * @ORM\Column(type="boolean")
     */
    private $touchRadio;

    /**
     * @ORM\Column(type="boolean")
     */
    private $metallicColor;

    /**
     * @ORM\Column(type="boolean")
     */
    private $childLock;

    /**
     * @ORM\Column(type="boolean")
     */
    private $LEDLightsFront;

    /**
     * @ORM\Column(type="boolean")
     */
    private $LEDLightsRear;

    /**
     * @ORM\Column(type="boolean")
     */
    private $LEDInterrior;

    /**
     * @ORM\Column(type="boolean")
     */
    private $leatherSeats;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sportSeats;

    /**
     * @ORM\Column(type="boolean")
     */
    private $rearParkingCamera;

    /**
     * @ORM\Column(type="boolean")
     */
    private $seatHeating;

    /**
     * @ORM\Column(type="boolean")
     */
    private $handsfree;

    /**
     * @ORM\ManyToOne(targetEntity=Vehicle::class, inversedBy="additionalEquipment")
     */
    private $vehicle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAbs(): ?bool
    {
        return $this->abs;
    }

    public function setAbs(bool $abs): self
    {
        $this->abs = $abs;

        return $this;
    }

    public function getEsp(): ?bool
    {
        return $this->esp;
    }

    public function setEsp(bool $esp): self
    {
        $this->esp = $esp;

        return $this;
    }

    public function getRemoteLocking(): ?bool
    {
        return $this->remoteLocking;
    }

    public function setRemoteLocking(bool $remoteLocking): self
    {
        $this->remoteLocking = $remoteLocking;

        return $this;
    }

    public function getIsofix(): ?bool
    {
        return $this->isofix;
    }

    public function setIsofix(bool $isofix): self
    {
        $this->isofix = $isofix;

        return $this;
    }

    public function getEngineImmobilizer(): ?bool
    {
        return $this->engineImmobilizer;
    }

    public function setEngineImmobilizer(bool $engineImmobilizer): self
    {
        $this->engineImmobilizer = $engineImmobilizer;

        return $this;
    }

    public function getStartStop(): ?bool
    {
        return $this->startStop;
    }

    public function setStartStop(bool $startStop): self
    {
        $this->startStop = $startStop;

        return $this;
    }

    public function getHac(): ?bool
    {
        return $this->hac;
    }

    public function setHac(bool $hac): self
    {
        $this->hac = $hac;

        return $this;
    }

    public function getRainSensors(): ?bool
    {
        return $this->rainSensors;
    }

    public function setRainSensors(string $rainSensors): self
    {
        $this->rainSensors = $rainSensors;

        return $this;
    }

    public function getLightSensors(): ?bool
    {
        return $this->lightSensors;
    }

    public function setLightSensors(bool $lightSensors): self
    {
        $this->lightSensors = $lightSensors;

        return $this;
    }

    public function getAlarm(): ?bool
    {
        return $this->alarm;
    }

    public function setAlarm(bool $alarm): self
    {
        $this->alarm = $alarm;

        return $this;
    }

    public function getMultifunctionalSteeringWheel(): ?bool
    {
        return $this->multifunctionalSteeringWheel;
    }

    public function setMultifunctionalSteeringWheel(bool $multifunctionalSteeringWheel): self
    {
        $this->multifunctionalSteeringWheel = $multifunctionalSteeringWheel;

        return $this;
    }

    public function getParkSensors(): ?bool
    {
        return $this->parkSensors;
    }

    public function setParkSensors(bool $parkSensors): self
    {
        $this->parkSensors = $parkSensors;

        return $this;
    }

    public function getAlloyWheels(): ?bool
    {
        return $this->alloyWheels;
    }

    public function setAlloyWheels(bool $alloyWheels): self
    {
        $this->alloyWheels = $alloyWheels;

        return $this;
    }

    public function getClima(): ?bool
    {
        return $this->clima;
    }

    public function setClima(bool $clima): self
    {
        $this->clima = $clima;

        return $this;
    }

    public function getThirdStopLight(): ?bool
    {
        return $this->thirdStopLight;
    }

    public function setThirdStopLight(bool $thirdStopLight): self
    {
        $this->thirdStopLight = $thirdStopLight;

        return $this;
    }

    public function getCruiseControl(): ?bool
    {
        return $this->cruiseControl;
    }

    public function setCruiseControl(bool $cruiseControl): self
    {
        $this->cruiseControl = $cruiseControl;

        return $this;
    }

    public function getElectricWindowLiftersFront(): ?bool
    {
        return $this->electricWindowLiftersFront;
    }

    public function setElectricWindowLiftersFront(bool $electricWindowLiftersFront): self
    {
        $this->electricWindowLiftersFront = $electricWindowLiftersFront;

        return $this;
    }

    public function getElectricWindowLiftersRear(): ?bool
    {
        return $this->electricWindowLiftersRear;
    }

    public function setElectricWindowLiftersRear(bool $electricWindowLiftersRear): self
    {
        $this->electricWindowLiftersRear = $electricWindowLiftersRear;

        return $this;
    }

    public function getElectricFoldingMirrors(): ?bool
    {
        return $this->electricFoldingMirrors;
    }

    public function setElectricFoldingMirrors(bool $electricFoldingMirrors): self
    {
        $this->electricFoldingMirrors = $electricFoldingMirrors;

        return $this;
    }

    public function getTintedGlass(): ?bool
    {
        return $this->tintedGlass;
    }

    public function setTintedGlass(bool $tintedGlass): self
    {
        $this->tintedGlass = $tintedGlass;

        return $this;
    }

    public function getFogLights(): ?bool
    {
        return $this->fogLights;
    }

    public function setFogLights(bool $fogLights): self
    {
        $this->fogLights = $fogLights;

        return $this;
    }

    public function getRoofWindow(): ?bool
    {
        return $this->roofWindow;
    }

    public function setRoofWindow(bool $roofWindow): self
    {
        $this->roofWindow = $roofWindow;

        return $this;
    }

    public function getTouchRadio(): ?bool
    {
        return $this->touchRadio;
    }

    public function setTouchRadio(bool $touchRadio): self
    {
        $this->touchRadio = $touchRadio;

        return $this;
    }

    public function getMetallicColor(): ?bool
    {
        return $this->metallicColor;
    }

    public function setMetallicColor(bool $metallicColor): self
    {
        $this->metallicColor = $metallicColor;

        return $this;
    }

    public function getChildLock(): ?bool
    {
        return $this->childLock;
    }

    public function setChildLock(bool $childLock): self
    {
        $this->childLock = $childLock;

        return $this;
    }

    public function getLEDLightsFront(): ?bool
    {
        return $this->LEDLightsFront;
    }

    public function setLEDLightsFront(bool $LEDLightsFront): self
    {
        $this->LEDLightsFront = $LEDLightsFront;

        return $this;
    }

    public function getLEDLightsRear(): ?bool
    {
        return $this->LEDLightsRear;
    }

    public function setLEDLightsRear(bool $LEDLightsRear): self
    {
        $this->LEDLightsRear = $LEDLightsRear;

        return $this;
    }

    public function getLEDInterrior(): ?bool
    {
        return $this->LEDInterrior;
    }

    public function setLEDInterrior(bool $LEDInterrior): self
    {
        $this->LEDInterrior = $LEDInterrior;

        return $this;
    }

    public function getLeatherSeats(): ?bool
    {
        return $this->leatherSeats;
    }

    public function setLeatherSeats(bool $leatherSeats): self
    {
        $this->leatherSeats = $leatherSeats;

        return $this;
    }

    public function getSportSeats(): ?bool
    {
        return $this->sportSeats;
    }

    public function setSportSeats(bool $sportSeats): self
    {
        $this->sportSeats = $sportSeats;

        return $this;
    }

    public function getRearParkingCamera(): ?bool
    {
        return $this->rearParkingCamera;
    }

    public function setRearParkingCamera(bool $rearParkingCamera): self
    {
        $this->rearParkingCamera = $rearParkingCamera;

        return $this;
    }

    public function getSeatHeating(): ?bool
    {
        return $this->seatHeating;
    }

    public function setSeatHeating(bool $seatHeating): self
    {
        $this->seatHeating = $seatHeating;

        return $this;
    }

    public function getHandsfree(): ?bool
    {
        return $this->handsfree;
    }

    public function setHandsfree(bool $handsfree): self
    {
        $this->handsfree = $handsfree;

        return $this;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }
}
