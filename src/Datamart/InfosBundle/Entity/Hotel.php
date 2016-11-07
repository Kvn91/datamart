<?php

namespace Datamart\InfosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotel
 *
 * @ORM\Table(name="info_hotel")
 * @ORM\Entity(repositoryClass="Datamart\InfosBundle\Repository\HotelRepository")
 */
class Hotel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="global_id", type="string", length=10, unique=true)
     */
    private $globalId;

    /**
     * @var string
     *
     * @ORM\Column(name="code3", type="string", length=3, unique=true)
     */
    private $code3;

    /**
     * @var string
     *
     * @ORM\Column(name="code_pms", type="string", length=255, nullable=true)
     */
    private $codePms;

    /**
     * @var string
     *
     * @ORM\Column(name="code_crm", type="string", length=255, nullable=true)
     */
    private $codeCrm;

    /**
     * @var string
     *
     * @ORM\Column(name="code_budget", type="string", length=255, nullable=true)
     */
    private $codeBudget;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", length=255, nullable=true)
     */
    private $shortName;

    /**
     * @var string
     *
     * @ORM\Column(name="zone_1", type="string", length=255, nullable=true)
     */
    private $zone1;

    /**
     * @var string
     *
     * @ORM\Column(name="zone_2", type="string", length=255, nullable=true)
     */
    private $zone2;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=64, nullable=true)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country_code", type="string", length=2, nullable=true)
     */
    private $countryCode;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=64, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=64, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="manager_id", type="integer", nullable=true)
     */
    private $managerId;

    /**
     * @var int
     *
     * @ORM\Column(name="brand_id", type="integer", nullable=true)
     */
    private $brandId;

    /**
     * @var int
     *
     * @ORM\Column(name="pms_id", type="integer", nullable=true)
     */
    private $pmsId;

    /**
     * @var int
     *
     * @ORM\Column(name="booking_engine_id", type="integer", nullable=true)
     */
    private $bookingEngineId;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_rooms", type="integer", nullable=true)
     */
    private $nbRooms;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_stars", type="integer", nullable=true)
     */
    private $nbStars;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_group", type="string", length=255, nullable=true)
     */
    private $ownerGroup;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_of_service", type="date", nullable=true)
     */
    private $dateOfService;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255, nullable=true, unique=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=true, unique=true)
     */
    private $longitude;

    /**
     * @var int
     *
     * @ORM\Column(name="under_construction", type="smallint")
     */
    private $underConstruction;

    /**
     * @var int
     *
     * @ORM\Column(name="isoperimeter", type="smallint", nullable=true)
     */
    private $isoperimeter;

    /**
     * @var string
     *
     * @ORM\Column(name="management", type="string", length=255, nullable=true)
     */
    private $management;

    /**
     * @var string
     *
     * @ORM\Column(name="analyst", type="string", length=255, nullable=true)
     */
    private $analyst;

    /**
     * @var string
     *
     * @ORM\Column(name="connectivity", type="string", length=255, nullable=true)
     */
    private $connectivity;

    /**
     * @var string
     *
     * @ORM\Column(name="data_source", type="string", length=255, nullable=true)
     */
    private $dataSource;

    /**
     * @var int
     *
     * @ORM\Column(name="data_auto", type="smallint")
     */
    private $dataAuto;

    /**
     * @var int
     *
     * @ORM\Column(name="active", type="smallint")
     */
    private $active;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set globalId
     *
     * @param string $globalId
     *
     * @return Hotel
     */
    public function setGlobalId($globalId)
    {
        $this->globalId = $globalId;

        return $this;
    }

    /**
     * Get globalId
     *
     * @return string
     */
    public function getGlobalId()
    {
        return $this->globalId;
    }

    /**
     * Set code3
     *
     * @param string $code3
     *
     * @return Hotel
     */
    public function setCode3($code3)
    {
        $this->code3 = $code3;

        return $this;
    }

    /**
     * Get code3
     *
     * @return string
     */
    public function getCode3()
    {
        return $this->code3;
    }

    /**
     * Set codePms
     *
     * @param string $codePms
     *
     * @return Hotel
     */
    public function setCodePms($codePms)
    {
        $this->codePms = $codePms;

        return $this;
    }

    /**
     * Get codePms
     *
     * @return string
     */
    public function getCodePms()
    {
        return $this->codePms;
    }

    /**
     * Set codeCrm
     *
     * @param string $codeCrm
     *
     * @return Hotel
     */
    public function setCodeCrm($codeCrm)
    {
        $this->codeCrm = $codeCrm;

        return $this;
    }

    /**
     * Get codeCrm
     *
     * @return string
     */
    public function getCodeCrm()
    {
        return $this->codeCrm;
    }

    /**
     * Set codeBudget
     *
     * @param string $codeBudget
     *
     * @return Hotel
     */
    public function setCodeBudget($codeBudget)
    {
        $this->codeBudget = $codeBudget;

        return $this;
    }

    /**
     * Get codeBudget
     *
     * @return string
     */
    public function getCodeBudget()
    {
        return $this->codeBudget;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Hotel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set shortName
     *
     * @param string $shortName
     *
     * @return Hotel
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set zone1
     *
     * @param string $zone1
     *
     * @return Hotel
     */
    public function setZone1($zone1)
    {
        $this->zone1 = $zone1;

        return $this;
    }

    /**
     * Get zone1
     *
     * @return string
     */
    public function getZone1()
    {
        return $this->zone1;
    }

    /**
     * Set zone2
     *
     * @param string $zone2
     *
     * @return Hotel
     */
    public function setZone2($zone2)
    {
        $this->zone2 = $zone2;

        return $this;
    }

    /**
     * Get zone2
     *
     * @return string
     */
    public function getZone2()
    {
        return $this->zone2;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Hotel
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return Hotel
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Hotel
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set countryCode
     *
     * @param string $countryCode
     *
     * @return Hotel
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Get countryCode
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Hotel
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return Hotel
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Hotel
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set managerId
     *
     * @param integer $managerId
     *
     * @return Hotel
     */
    public function setManagerId($managerId)
    {
        $this->managerId = $managerId;

        return $this;
    }

    /**
     * Get managerId
     *
     * @return int
     */
    public function getManagerId()
    {
        return $this->managerId;
    }

    /**
     * Set brandId
     *
     * @param integer $brandId
     *
     * @return Hotel
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }

    /**
     * Get brandId
     *
     * @return int
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * Set pmsId
     *
     * @param integer $pmsId
     *
     * @return Hotel
     */
    public function setPmsId($pmsId)
    {
        $this->pmsId = $pmsId;

        return $this;
    }

    /**
     * Get pmsId
     *
     * @return int
     */
    public function getPmsId()
    {
        return $this->pmsId;
    }

    /**
     * Set bookingEngineId
     *
     * @param integer $bookingEngineId
     *
     * @return Hotel
     */
    public function setBookingEngineId($bookingEngineId)
    {
        $this->bookingEngineId = $bookingEngineId;

        return $this;
    }

    /**
     * Get bookingEngineId
     *
     * @return int
     */
    public function getBookingEngineId()
    {
        return $this->bookingEngineId;
    }

    /**
     * Set nbRooms
     *
     * @param integer $nbRooms
     *
     * @return Hotel
     */
    public function setNbRooms($nbRooms)
    {
        $this->nbRooms = $nbRooms;

        return $this;
    }

    /**
     * Get nbRooms
     *
     * @return int
     */
    public function getNbRooms()
    {
        return $this->nbRooms;
    }

    /**
     * Set nbStars
     *
     * @param integer $nbStars
     *
     * @return Hotel
     */
    public function setNbStars($nbStars)
    {
        $this->nbStars = $nbStars;

        return $this;
    }

    /**
     * Get nbStars
     *
     * @return int
     */
    public function getNbStars()
    {
        return $this->nbStars;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Hotel
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set ownerGroup
     *
     * @param string $ownerGroup
     *
     * @return Hotel
     */
    public function setOwnerGroup($ownerGroup)
    {
        $this->ownerGroup = $ownerGroup;

        return $this;
    }

    /**
     * Get ownerGroup
     *
     * @return string
     */
    public function getOwnerGroup()
    {
        return $this->ownerGroup;
    }

    /**
     * Set dateOfService
     *
     * @param \DateTime $dateOfService
     *
     * @return Hotel
     */
    public function setDateOfService($dateOfService)
    {
        $this->dateOfService = $dateOfService;

        return $this;
    }

    /**
     * Get dateOfService
     *
     * @return \DateTime
     */
    public function getDateOfService()
    {
        return $this->dateOfService;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Hotel
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Hotel
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set underConstruction
     *
     * @param integer $underConstruction
     *
     * @return Hotel
     */
    public function setUnderConstruction($underConstruction)
    {
        $this->underConstruction = $underConstruction;

        return $this;
    }

    /**
     * Get underConstruction
     *
     * @return int
     */
    public function getUnderConstruction()
    {
        return $this->underConstruction;
    }

    /**
     * Set isoperimeter
     *
     * @param integer $isoperimeter
     *
     * @return Hotel
     */
    public function setIsoperimeter($isoperimeter)
    {
        $this->isoperimeter = $isoperimeter;

        return $this;
    }

    /**
     * Get isoperimeter
     *
     * @return int
     */
    public function getIsoperimeter()
    {
        return $this->isoperimeter;
    }

    /**
     * Set management
     *
     * @param string $management
     *
     * @return Hotel
     */
    public function setManagement($management)
    {
        $this->management = $management;

        return $this;
    }

    /**
     * Get management
     *
     * @return string
     */
    public function getManagement()
    {
        return $this->management;
    }

    /**
     * Set analyst
     *
     * @param string $analyst
     *
     * @return Hotel
     */
    public function setAnalyst($analyst)
    {
        $this->analyst = $analyst;

        return $this;
    }

    /**
     * Get analyst
     *
     * @return string
     */
    public function getAnalyst()
    {
        return $this->analyst;
    }

    /**
     * Set connectivity
     *
     * @param string $connectivity
     *
     * @return Hotel
     */
    public function setConnectivity($connectivity)
    {
        $this->connectivity = $connectivity;

        return $this;
    }

    /**
     * Get connectivity
     *
     * @return string
     */
    public function getConnectivity()
    {
        return $this->connectivity;
    }

    /**
     * Set dataSource
     *
     * @param string $dataSource
     *
     * @return Hotel
     */
    public function setDataSource($dataSource)
    {
        $this->dataSource = $dataSource;

        return $this;
    }

    /**
     * Get dataSource
     *
     * @return string
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * Set dataAuto
     *
     * @param integer $dataAuto
     *
     * @return Hotel
     */
    public function setDataAuto($dataAuto)
    {
        $this->dataAuto = $dataAuto;

        return $this;
    }

    /**
     * Get dataAuto
     *
     * @return int
     */
    public function getDataAuto()
    {
        return $this->dataAuto;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return Hotel
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return int
     */
    public function getActive()
    {
        return $this->active;
    }
}

