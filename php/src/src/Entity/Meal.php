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
}