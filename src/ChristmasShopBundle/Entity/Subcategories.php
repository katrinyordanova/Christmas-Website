<?php

namespace ChristmasShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subcategories
 *
 * @ORM\Table(name="subcategories")
 * @ORM\Entity(repositoryClass="ChristmasShopBundle\Repository\SubcategoriesRepository")
 */
class Subcategories
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
     * @ORM\Column(name="subcategories", type="string", length=50)
     */
    private $subcategories;

    /**
    * @ORM\ManyToOne(targetEntity="ChristmasShopBundle\Entity\Category", inversedBy="subcategories")
    * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;


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
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getSubcategories()
    {
        return $this->subcategories;
    }

    /**
     * @param string $subcategories
     */
    public function setSubcategories($subcategories)
    {
        $this->subcategories = $subcategories;
    }
}

