<?php

namespace Datamart\MappingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ratecategory
 *
 * @ORM\Table(name="mapping_ratecategory",indexes={@ORM\Index(name="search_idx", columns={"original_field"})})
 * @ORM\Entity(repositoryClass="Datamart\MappingsBundle\Repository\RatecategoryRepository")
 */
class Ratecategory
{
    const NB_RATECATEGORIES_PER_PAGE = 50;

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
     * @return Ratecategory
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
     * @return Ratecategory
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

