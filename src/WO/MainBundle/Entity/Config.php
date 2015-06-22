<?php

namespace WO\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="config")
 * @ORM\Entity
 */
class Config
{
    const LAYOUT_BOOTSTRAP = 'bootstrap';
    const LAYOUT_SEMANTIC = 'semantic';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="offline", type="boolean", nullable=true)
     */
    private $offline = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="layout", type="string", length=50)
     */
    private $layout = 'bootstrap';

    /**
     * @var string
     *
     * @ORM\Column(name="event_overwrite_protection", type="boolean", nullable=true)
     */
    private $event_overwrite_protection = false;


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
     * Set offline
     *
     * @param integer $offline
     * @return Config
     */
    public function setOffline($offline)
    {
        $this->offline = $offline;

        return $this;
    }

    /**
     * Get offline
     *
     * @return integer 
     */
    public function getOffline()
    {
        return $this->offline;
    }

    /**
     * Set layout
     *
     * @param string $layout
     * @return Config
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Get layout
     *
     * @return string 
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param string $event_overwrite_protection
     */
    public function setEventOverwriteProtection($event_overwrite_protection)
    {
        $this->event_overwrite_protection = $event_overwrite_protection;
    }

    /**
     * @return string
     */
    public function getEventOverwriteProtection()
    {
        return $this->event_overwrite_protection;
    }

}
