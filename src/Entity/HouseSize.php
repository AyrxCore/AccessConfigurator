<?php

namespace App\Entity;

use App\Entity\UuidGenerator\UuidBaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="house_size")
 * @ORM\Entity(repositoryClass="App\Repository\HouseSizeRepository")
 */
class HouseSize extends UuidBaseEntity
{
    /**
     * @var HouseModel
     * @ORM\ManyToOne(targetEntity="App\Entity\HouseModel", inversedBy="houseSizes")
     */
    private $houseModel;
    
    /**
     * @var int
     * @ORM\Column(type="integer", length=255, nullable=true)
     */
    private $surface;
    
    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lowerPrice;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgRdc;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgFloor;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;
    
    /**
     * @var Project
     * @ORM\OneToOne(targetEntity="App\Entity\Project", inversedBy="houseSize", cascade={"persist"}, orphanRemoval=true)
     */
    private $project;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * @return HouseModel
     */
    public function getHouseModel()
    {
        return $this->houseModel;
    }

    /**
     * @param HouseModel $houseModel
     * @return HouseSize
     */
    public function setHouseModel($houseModel)
    {
        $this->houseModel = $houseModel;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->lowerPrice;
    }

    /**
     * @param int $lowerPrice
     * @return HouseSize
     */
    public function setPrice($lowerPrice)
    {
        $this->lowerPrice = $lowerPrice;
        return $this;
    }

    /**
     * @return string
     */
    public function getImgRdc()
    {
        return $this->imgRdc;
    }

    /**
     * @param string $imgRdc
     * @return HouseSize
     */
    public function setImgRdc($imgRdc)
    {
        $this->imgRdc = $imgRdc;
        return $this;
    }

    /**
     * @return string
     */
    public function getImgFloor()
    {
        return $this->imgFloor;
    }

    /**
     * @param string $imgFloor
     * @return HouseSize
     */
    public function setImgFloor($imgFloor)
    {
        $this->imgFloor = $imgFloor;
        return $this;
    }

    /**
     * @return int
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * @param int $surface
     * @return HouseSize
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return HouseSize
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    
}
