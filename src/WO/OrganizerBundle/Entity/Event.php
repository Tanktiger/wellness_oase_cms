<?php

namespace WO\OrganizerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="WO\OrganizerBundle\Entity\EventRepository")
 */
class Event
{
    const NON_ASSIGNED_COLOR = 'grey';
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
     * @ORM\Column(name="date_start", type="datetime")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="datetime")
     */
    private $dateEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="customer", type="string", length=255)
     */
    private $customer;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="text", nullable=true)
     */
    private $info;

    /**
     * @var string
     *
     * @ORM\Column(name="extrainfo", type="text", nullable=true)
     */
    private $extrainfo;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=50, nullable=true)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="day", type="date")
     */
    private $day;

    /**
     * @var boolean
     *
     * @ORM\Column(name="canceled", type="boolean", nullable=true)
     */
    private $canceled = null;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime")
     */
    private $createDate;

    /**
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="events", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id", nullable=true)
     **/
    private $employee;

    /**
     * @ORM\ManyToOne(targetEntity="Location", inversedBy="events", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id", nullable=true)
     **/
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="Paymentmethod", inversedBy="events", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="paymentmethod_id", referencedColumnName="id",nullable=true)
     **/
    private $paymentmethod;

    /**
     * @ORM\ManyToOne(targetEntity="WO\MainBundle\Entity\User", inversedBy="events", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $user;

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
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return Event
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return Event
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set customer
     *
     * @param string $customer
     * @return Event
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return string 
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set info
     *
     * @param string $info
     * @return Event
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string 
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Event
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
     * Set day
     *
     * @param \DateTime $day
     * @return Event
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return \DateTime 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return Event
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime 
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set canceled
     *
     * @param boolean $canceled
     * @return Event
     */
    public function setCanceled($canceled)
    {
        $this->canceled = $canceled;

        return $this;
    }

    /**
     * Get canceled
     *
     * @return boolean 
     */
    public function getCanceled()
    {
        return $this->canceled;
    }

    /**
     * @return mixed
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param mixed $employee
     */
    public function setEmployee($employee)
    {
        $this->employee = $employee;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getPaymentmethod()
    {
        return $this->paymentmethod;
    }

    /**
     * @param mixed $paymentmethod
     */
    public function setPaymentmethod($paymentmethod)
    {
        $this->paymentmethod = $paymentmethod;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getExtrainfo()
    {
        return $this->extrainfo;
    }

    /**
     * @param string $extrainfo
     */
    public function setExtrainfo($extrainfo)
    {
        $this->extrainfo = $extrainfo;
    }

}
