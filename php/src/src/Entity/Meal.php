<?php
/**
 * Created by PhpStorm.
 * User: remy
 * Date: 28/10/18
 * Time: 16:10
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 */
class Meal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Recipe")
     * @ORM\JoinColumn(name="main_recipe_id", referencedColumnName="id")
     */
    private $mainCourse;

    /**
     * @ORM\ManyToOne(targetEntity="Recipe")
     * @ORM\JoinColumn(name="entry_recipe_id", referencedColumnName="id")
     */
    private $entry;

    /**
     * @ORM\ManyToOne(targetEntity="Recipe")
     * @ORM\JoinColumn(name="desert_recipe_id", referencedColumnName="id")
     */
    private $desert;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $consomed = false;


    public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    public function isConsomed(): bool
    {
        return $this->consomed;
    }

    public function setConsomed(bool $consomed): void
    {
        $this->consomed = $consomed;
    }

    public function getMainCourse()
    {
        return $this->mainCourse;
    }

    public function setMainCourse($mainCourse): void
    {
        $this->mainCourse = $mainCourse;
    }

    public function getEntry()
    {
        return $this->entry;
    }

    public function setEntry($entry): void
    {
        $this->entry = $entry;
    }

    public function getDesert()
    {
        return $this->desert;
    }

    public function setDesert($desert): void
    {
        $this->desert = $desert;
    }




}