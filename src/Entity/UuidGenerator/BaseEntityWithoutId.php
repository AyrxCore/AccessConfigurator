<?php

namespace App\Entity\UuidGenerator;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BaseEntityWithoutId
 * @package BaseEntityBundle\Entity
 * @ORM\MappedSuperclass()
 */
abstract class BaseEntityWithoutId implements BaseEntityInterface
{
    public function __construct()
    {
        $this->created = new \DateTime();
        $this->modified = new \DateTime();
    }
    
    public function __clone()
    {
        $this->created  = clone $this->created;
        $this->modified = clone $this->modified;
    }
    
    /**
     * @var \DateTime
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;
    
    /**
     * @var \DateTime
     * @ORM\Column(name="modified", type="datetime")
     */
    private $modified;
    
    
    /**
     * @param \DateTime $created
     * @return BaseEntityInterface
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
        return $this;
    }
    
    /**
     * @return \DateTime
     */
    public function getCreated():\DateTime
    {
        return $this->created;
    }
    
    /**
     * @param \DateTime $modified
     * @return BaseEntityInterface
     */
    public function setModified(\DateTime $modified)
    {
        $this->modified = $modified;
        return $this;
    }
    
    /**
     * @return \DateTime
     */
    public function getModified():\DateTime
    {
        return $this->modified;
    }
}