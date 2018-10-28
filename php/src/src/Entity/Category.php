<?php
/**
 * Created by PhpStorm.
 * User: remy
 * Date: 28/10/18
 * Time: 16:22
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity()
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Good", mappedBy="category")
     */
    private $goods;

    public function __construct()
    {
        $this->$goods = new \Doctrine\Common\Collections\ArrayCollection();
    }

}