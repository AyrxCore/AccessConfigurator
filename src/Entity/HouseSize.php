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
     * @ORM\ManyToOne(targetEntity="App\Entity\HouseModel", inversedBy="houseSizes")
     */
    private $houseModel;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $surface;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgRdc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgFloor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;
    
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
        return $this->price;
    }

    /**
     * @param int $price
     * @return HouseSize
     */
    public function setPrice($price)
    {
        $this->price = $price;
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
