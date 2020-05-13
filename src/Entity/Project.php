<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\UuidGenerator\UuidBaseEntity;

/**
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project extends UuidBaseEntity
{
    /**
     * @var User
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    /**
     * @var string
     * @ORM\Column(name="name", length=255, nullable=true)
     */
    private $name;
    
    /**
     * @var string
     * @ORM\Column(name="client_name", length=255, nullable=true)
     */
    private $clientName;
    
    /**
     * @var string
     * @ORM\Column(name="client_address", length=255, nullable=true)
     */
    private $clientAddress;
    
    /**
     * @var HouseModel
     * @ORM\OneToOne(targetEntity="App\Entity\HouseModel")
     * @ORM\JoinColumn(name="house_model_id", referencedColumnName="id")
     */
    private $houseModel;
    
    /**
     * @var HouseSize
     * @ORM\OneToOne(targetEntity="App\Entity\HouseSize")
     * @ORM\JoinColumn(name="house_size_id", referencedColumnName="id")
     */
    private $houseSize;
    
    /**
     * @var array
     * @ORM\Column(name="state_project", type="json")
     */
    private $stateProject;
    
    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
    
    /**
     * @param User $user
     * @return Project
     */
    public function setUser(User $user): Project
    {
        $this->user = $user;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     * @return Project
     */
    public function setName(string $name): Project
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getClientName(): string
    {
        return $this->clientName;
    }
    
    /**
     * @param string $clientName
     * @return Project
     */
    public function setClientName(string $clientName): Project
    {
        $this->clientName = $clientName;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getClientAddress(): string
    {
        return $this->clientAddress;
    }
    
    /**
     * @param string $clientAddress
     * @return Project
     */
    public function setClientAddress(string $clientAddress): Project
    {
        $this->clientAddress = $clientAddress;
        return $this;
    }
    
    /**
     * @return HouseModel
     */
    public function getHouseModel(): HouseModel
    {
        return $this->houseModel;
    }
    
    /**
     * @param HouseModel $houseModel
     * @return Project
     */
    public function setHouseModel(HouseModel $houseModel): Project
    {
        $this->houseModel = $houseModel;
        return $this;
    }
    
    /**
     * @return HouseSize
     */
    public function getHouseSize(): HouseSize
    {
        return $this->houseSize;
    }
    
    /**
     * @param HouseSize $houseSize
     * @return Project
     */
    public function setHouseSize(HouseSize $houseSize): Project
    {
        $this->houseSize = $houseSize;
        return $this;
    }
    
    /**
     * @return array
     */
    public function getStateProject(): array
    {
        return $this->stateProject;
    }
    
    /**
     * @param array $stateProject
     * @return Project
     */
    public function setStateProject(array $stateProject): Project
    {
        $this->stateProject = $stateProject;
        return $this;
    }
    
}