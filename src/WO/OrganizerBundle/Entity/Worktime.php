<?php

namespace WO\OrganizerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Worktime
 *
 * @ORM\Table(name="worktime")
 * @ORM\Entity(repositoryClass="WO\OrganizerBundle\Entity\WorktimeRepository")
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
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="worktime")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     **/
    private $employee;

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
}
