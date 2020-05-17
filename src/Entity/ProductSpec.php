<?php

namespace App\Entity;

use App\Entity\UuidGenerator\UuidBaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="product_spec")
 * @ORM\Entity(repositoryClass="App\Repository\ProductSpecRepository")
 */
class ProductSpec extends UuidBaseEntity
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="productSpec")
     */
    private $product;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $material;
    
    /**
     * @ORM\Column(type="json", length=255, nullable=true)
     */
    private $prices;

    public function __construct() {
        parent::__construct();
    }
    
    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return ProductSpec
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param string $product
     * @return ProductSpec
     */
    public function setProduct($product)
    {
        $this->product = $product;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }
    
    /**
     * @param mixed $img
     * @return ProductSpec
     */
    public function setImg($img)
    {
        $this->img = $img;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }
    
    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }
    
    /**
     * @return mixed
     */
    public function getMaterial()
    {
        return $this->material;
    }
    
    /**
     * @param mixed $material
     */
    public function setMaterial($material)
    {
        $this->material = $material;
    }
    
    /**
     * @return mixed
     */
    public function getPrices()
    {
        return $this->prices;
    }
    
    /**
     * @param mixed $prices
     */
    public function setPrices($prices)
    {
        $this->prices = $prices;
    }

}
