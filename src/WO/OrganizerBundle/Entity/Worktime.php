<?php

namespace WO\OrganizerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Worktime
 *
 * @ORM\Table(name="worktime")
 * @ORM\Entity(repositoryClass="WO\OrganizerBundle\Entity\WorktimeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Worktime
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
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="timerange", type="string", length=255, nullable=true)
     */
    private $timerange;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="time")
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="time")
     */
    private $end;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="worktime")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     **/
    private $employee;

    /**
     * @var boolean
     *
     * @ORM\Column(name="free", type="boolean", nullable=true)
     */
    private $free = null;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vacation", type="boolean", nullable=true)
     */
    private $vacation = null;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sick", type="boolean", nullable=true)
     */
    private $sick = null;

    /**
     * @var boolean
     *
     * @ORM\Column(name="on_demand", type="boolean", nullable=true)
     */
    private $onDemand = null;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=255)
     */
    private $info;

    public function __construct() {

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Worktime
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set timerange
     *
     * @param string $timerange
     * @return Worktime
     */
    public function setTimerange($timerange)
    {
        $this->timerange = $timerange;

        return $this;
    }

    /**
     * Get timerange
     *
     * @return string 
     */
    public function getTimerange()
    {
        return $this->timerange;
    }

    /**
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param \DateTime $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }

    /**
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param \DateTime $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return boolean
     */
    public function isFree()
    {
        return $this->free;
    }

    /**
     * @param boolean $free
     */
    public function setFree($free)
    {
        $this->free = $free;
    }

    /**
     * @return boolean
     */
    public function isOnDemand()
    {
        return $this->onDemand;
    }

    /**
     * @param boolean $onDemand
     */
    public function setOnDemand($onDemand)
    {
        $this->onDemand = $onDemand;
    }

    /**
     * @return boolean
     */
    public function isSick()
    {
        return $this->sick;
    }

    /**
     * @param boolean $sick
     */
    public function setSick($sick)
    {
        $this->sick = $sick;
    }

    /**
     * @return boolean
     */
    public function isVacation()
    {
        return $this->vacation;
    }

    /**
     * @param boolean $vacation
     */
    public function setVacation($vacation)
    {
        $this->vacation = $vacation;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist() {
        $this->setTimerange($this->getStart()->format('H:i') . ' - ' . $this->getEnd()->format('H:i'));
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate() {
        $this->setTimerange($this->getStart()->format('H:i') . ' - ' . $this->getEnd()->format('H:i'));
    }

    /**
     * @param string $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

}
