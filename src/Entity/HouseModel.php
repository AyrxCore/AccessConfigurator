<?php

namespace App\Entity;

use App\Entity\UuidGenerator\UuidBaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="house_model")
 * @ORM\Entity(repositoryClass="App\Repository\HouseModelRepository")
 */
class HouseModel extends UuidBaseEntity
{
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lowerPrice;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;
    
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\HouseSize", mappedBy="houseModel", cascade={"persist"}, orphanRemoval=true)
     */
    private $houseSizes;
    
    /**
     * @var Project
     * @ORM\OneToMany(targetEntity="App\Entity\Project", mappedBy="houseModel")
     */
    private $project;
    
    public function __construct()
    {
        parent::__construct();
        $this->houseSizes = new ArrayCollection();
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     * @return HouseModel
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return HouseModel
     */
    public function setLowerPrice($lowerPrice)
    {
        $this->lowerPrice = $lowerPrice;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }
    
    /**
     * @param string $img
     * @return HouseModel
     */
    public function setImg($img)
    {
        $this->img = $img;
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
     * @return HouseModel
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    
    /**
     * @return ArrayCollection
     */
    public function getHouseSizes(): ArrayCollection
    {
        return $this->houseSizes;
    }
    
    /**
     * @param HouseSize $houseSize
     */
    public function addHouseSize(HouseSize $houseSize): void
    {
        $this->houseSizes->add($houseSize);
        $houseSize->setHouseModel($this);
    }
    
    /**
     * @param HouseSize $houseSize
     */
    public function removeHouseSize(HouseSize $houseSize): void
    {
        $this->houseSizes->removeElement($houseSize);
        $houseSize->setHouseModel(null);
    }
    
    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }
    
    /**
     * @param Project $project
     */
    public function setProject(Project $project): void
    {
        $this->project = $project;
    }
}
