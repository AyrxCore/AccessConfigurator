<?php

namespace App\Entity;

use App\Entity\UuidGenerator\UuidBaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product extends UuidBaseEntity
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="product")
     */
    private $category;
    
    /**
     * @ORM\OneToMany(targetEntity="ProductSpec", mappedBy="product")
     */
    private $productSpec;
    
    public function __construct() {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return Product
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getProductSpec()
    {
        return $this->productSpec;
    }
    
    /**
     * @param mixed $productSpec
     */
    public function setProductSpec($productSpec): void
    {
        $this->productSpec = $productSpec;
    }

}
