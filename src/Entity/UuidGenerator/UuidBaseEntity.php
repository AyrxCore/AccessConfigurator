<?php

namespace App\Entity\UuidGenerator;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * BaseEntity
 */
class UuidBaseEntity extends BaseEntityWithoutId
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     */
    protected $id;
    
    public function __construct($id = null)
    {
        parent::__construct();
        if($id !== null){
            $this->id = $id;
        }
        else {
            $this->id = Uuid::uuid4()->toString();
        }
        
    }
    
    public function __clone()
    {
        parent::__clone();
        $this->id = Uuid::uuid4()->toString();
    }
    
    /**
     * @return string
     */
    public function getId():string
    {
        return $this->id;
    }
    
    /**
     * @param string $id
     * @return UuidBaseEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
}
