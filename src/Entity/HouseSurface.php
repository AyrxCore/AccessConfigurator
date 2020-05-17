<?php

namespace App\Entity;

use App\Entity\UuidGenerator\UuidBaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="house_surface")
 * @ORM\Entity(repositoryClass="App\Repository\HouseSurfaceRepository")
 */
class HouseSurface extends UuidBaseEntity
{
    /**
     * @var HouseModel
     * @ORM\Column(name="house_model")
     * @ORM\ManyToOne(targetEntity="App\Entity\HouseModel", inversedBy="houseSurfaces")
     */
    private $houseModel;
    
    /**
     * @var int
     * @ORM\Column(name="surface", type="integer", length=255, nullable=true)
     */
    private $surface;
    
    /**
     * @var int
     * @ORM\Column(name="lower_price", type="integer", nullable=true)
     */
    private $lowerPrice;

    /**
     * @var string
     * @ORM\Column(name="img_rdc", type="string", length=255, nullable=true)
     */
    private $imgRdc;

    /**
     * @var string
     * @ORM\Column(name="img_floor", type="string", length=255, nullable=true)
     */
    private $imgFloor;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;
    
    /**
     * @var Project
     * @ORM\OneToMany(targetEntity="App\Entity\Project", mappedBy="houseSurface")
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
     * @return HouseSurface
     */
    public function setHouseModel($houseModel)
    {
        $this->houseModel = $houseModel;
        return $this;
    }

    /**
     * @return int
     */
    public function getLowerPrice()
    {
        return $this->lowerPrice;
    }

    /**
     * @param int $lowerPrice
     * @return HouseSurface
     */
    public function setLowerPrice($lowerPrice)
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
     * @return HouseSurface
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
     * @return HouseSurface
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
     * @return HouseSurface
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
     * @return HouseSurface
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    
}
