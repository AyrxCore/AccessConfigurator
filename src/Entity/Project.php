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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="projects")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\HouseModel", cascade={"persist"}, inversedBy="project")
     */
    private $houseModel;
    
    /**
     * @var HouseSurface
     * @ORM\ManyToOne(targetEntity="App\Entity\HouseSurface", cascade={"persist"}, inversedBy="project")
     */
    private $houseSurface;
    
    /**
     * @var array
     * @ORM\Column(name="state_project", type="json", nullable=true)
     */
    private $stateProject;
    
    /**
     * @var bool
     * @ORM\Column(name="fully_configured_options")
     */
    private $fullyConfiguredOptions;
    
    public function __construct() {
        parent::__construct();
        $this->fullyConfiguredOptions = 0;
    }
    
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
    public function setUser(User $user = null): Project
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
    public function getHouseModel()
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
     * @return HouseSurface
     */
    public function getHouseSurface()
    {
        return $this->houseSurface;
    }
    
    /**
     * @param HouseSurface $houseSurface
     * @return Project
     */
    public function setHouseSurface(HouseSurface $houseSurface): Project
    {
        $this->houseSurface = $houseSurface;
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
    
    /**
     * @return bool
     */
    public function isFullyConfiguredOptions(): bool
    {
        return $this->fullyConfiguredOptions;
    }
    
    /**
     * @param bool $fullyConfiguredOptions
     * @return Project
     */
    public function setFullyConfiguredOptions(bool $fullyConfiguredOptions): Project
    {
        $this->fullyConfiguredOptions = $fullyConfiguredOptions;
        return $this;
    }
    
}