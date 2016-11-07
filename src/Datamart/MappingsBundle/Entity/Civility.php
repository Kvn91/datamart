<?php

namespace Datamart\MappingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Civility
 *
 * @ORM\Table(name="mapping_civility",indexes={@ORM\Index(name="search_idx", columns={"original_field"})})
 * @ORM\Entity(repositoryClass="Datamart\MappingsBundle\Repository\CivilityRepository")
 */
class Civility
{
    const NB_CIVILITIES_PER_PAGE = 10;
    
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
     * @return Civility
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
     * @return Civility
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
}

