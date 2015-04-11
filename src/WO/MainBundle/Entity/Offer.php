<?php

namespace WO\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
 * @ORM\Table(name="offer")
 * @ORM\Entity(repositoryClass="WO\MainBundle\Entity\OfferRepository")

 */
class Offer
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
     * @var \DateTime
     *
     * @ORM\Column(name="offer_start", type="datetime")
     */
    private $offerStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="offer_end", type="datetime")
     */
    private $offerEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="offer_price", type="string", length=255)
     */
    private $offerPrice;

    /**
     * @ORM\ManyToOne(targetEntity="WO\MainBundle\Entity\Service", inversedBy="offers", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     **/
    private $service;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime")
     */
    private $createDate;

    public function __construct() {
        $this->createDate = new \DateTime('now');
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
     * Set offerStart
     *
     * @param \DateTime $offerStart
     * @return Offer
     */
    public function setOfferStart($offerStart)
    {
        $this->offerStart = $offerStart;

        return $this;
    }

    /**
     * Get offerStart
     *
     * @return \DateTime 
     */
    public function getOfferStart()
    {
        return $this->offerStart;
    }

    /**
     * Set offerEnd
     *
     * @param \DateTime $offerEnd
     * @return Offer
     */
    public function setOfferEnd($offerEnd)
    {
        $this->offerEnd = $offerEnd;

        return $this;
    }

    /**
     * Get offerEnd
     *
     * @return \DateTime 
     */
    public function getOfferEnd()
    {
        return $this->offerEnd;
    }

    /**
     * Set offerPrice
     *
     * @param string $offerPrice
     * @return Offer
     */
    public function setOfferPrice($offerPrice)
    {
        $this->offerPrice = $offerPrice;

        return $this;
    }

    /**
     * Get offerPrice
     *
     * @return string 
     */
    public function getOfferPrice()
    {
        return $this->offerPrice;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @param \DateTime $createDate
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

}
