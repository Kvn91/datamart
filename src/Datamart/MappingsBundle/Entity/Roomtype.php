<?php

namespace Datamart\MappingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roomtype
 *
 * @ORM\Table(name="mapping_roomtype",indexes={@ORM\Index(name="search_idx", columns={"original_field"})})
 * @ORM\Entity(repositoryClass="Datamart\MappingsBundle\Repository\RoomtypeRepository")
 */
class Roomtype
{
    const NB_ROOMTYPES_PER_PAGE = 50;

    /**
     * @ORM\ManyToOne(targetEntity="Datamart\InfosBundle\Entity\Hotel")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hotel;

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
     * @ORM\Column(name="original_field", type="string", length=255, nullable=true)
     */
    private $originalField;

    /**
     * @var string
     *
     * @ORM\Column(name="mapped_field", type="string", length=255, nullable=true)
     */
    private $mappedField;


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
     * Set originalField
     *
     * @param string $originalField
     *
     * @return Roomtype
     */
    public function setOriginalField($originalField)
    {
        $this->originalField = $originalField;

        return $this;
    }

    /**
     * Get originalField
     *
     * @return string
     */
    public function getOriginalField()
    {
        return $this->originalField;
    }

    /**
     * Set mappedField
     *
     * @param string $mappedField
     *
     * @return Roomtype
     */
    public function setMappedField($mappedField)
    {
        $this->mappedField = $mappedField;

        return $this;
    }

    /**
     * Get mappedField
     *
     * @return string
     */
    public function getMappedField()
    {
        return $this->mappedField;
    }

    /**
     * Set hotel
     *
     * @param \Datamart\InfosBundle\Entity\Hotel $hotel
     *
     * @return Roomtype
     */
    public function setHotel(\Datamart\InfosBundle\Entity\Hotel $hotel = null)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return \Datamart\InfosBundle\Entity\Hotel
     */
    public function getHotel()
    {
        return $this->hotel;
    }
}
