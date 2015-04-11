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
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="worktime")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     **/
    private $employee;

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

}
