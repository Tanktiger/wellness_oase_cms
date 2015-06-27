<?php

namespace WO\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="WO\MainBundle\Entity\ServiceRepository")
 */
class Service
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=255, nullable=true)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="shortname", type="string", length=50)
     */
    private $shortname;

    /**
     * @var boolean
     *
     * @ORM\Column(name="show_online", type="boolean", nullable=true)
     */
    private $show_online = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="glowe", type="boolean", nullable=true)
     */
    private $glowe = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="smallint")
     */
    private $position = 0;

    /**
     * @ORM\ManyToOne(targetEntity="WO\MainBundle\Entity\ServiceCategory", inversedBy="services", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     **/
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="WO\MainBundle\Entity\Offer", mappedBy="service")
     **/
    private $offers;

    /**
     * @ORM\OneToMany(targetEntity="WO\MainBundle\Entity\Service", mappedBy="parentService")
     */
    private $subServices;

    /**
     * @ORM\ManyToOne(targetEntity="WO\MainBundle\Entity\Service", inversedBy="subServices")
     * @ORM\JoinColumn(name="parent_service_id", referencedColumnName="id")
     */
    private $parentService;

    public function __toString() {
        return $this->name;
    }

    public function __construct() {
        $this->subServices = new ArrayCollection();
    }
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Service
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
     * Set price
     *
     * @param string $price
     * @return Service
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Service
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set duration
     *
     * @param string $duration
     * @return Service
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set offer
     *
     * @param boolean $offer
     * @return Service
     */
    public function setOffer($offer)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return boolean 
     */
    public function getOffer()
    {
        return $this->offer;
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
     * @return mixed
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * @param mixed $offers
     */
    public function setOffers($offers)
    {
        $this->offers = $offers;
    }

    /**
     * @param string $shortname
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;
    }

    /**
     * @return string
     */
    public function getShortname()
    {
        return $this->shortname;
    }

    /**
     * @param boolean $show_online
     */
    public function setShowOnline($show_online)
    {
        $this->show_online = $show_online;
    }

    /**
     * @return boolean
     */
    public function getShowOnline()
    {
        return $this->show_online;
    }

    /**
     * @return boolean
     */
    public function isGlowe()
    {
        return $this->glowe;
    }

    /**
     * @param boolean $glowe
     */
    public function setGlowe($glowe)
    {
        $this->glowe = $glowe;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getSubServices()
    {
        return $this->subServices;
    }

    /**
     * @param mixed $subServices
     */
    public function setSubServices($subServices)
    {
        $this->subServices = $subServices;
    }

    /**
     * @param mixed $subServices
     */
    public function addSubServices($subServices)
    {
        $this->subServices[] = $subServices;
    }

    /**
     * @return mixed
     */
    public function getParentService()
    {
        return $this->parentService;
    }

    /**
     * @param mixed $parentService
     */
    public function setParentService($parentService)
    {
        $this->parentService = $parentService;
    }



}
