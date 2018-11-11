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
     * @ORM\OneToMany(targetEntity="Good", mappedBy="category", cascade={"persist"})
     */
    private $goods;

    public function __construct()
    {
        $this->goods = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getGoods() : ArrayCollection
    {
        return $this->goods;
    }

    public function setGoods(ArrayCollection $goods): void
    {
        $this->goods = $goods;
    }

    public function addGood(Good $good) : void
    {
        if ($this->goods->contains($good)) {
            return;
        }
        $this->goods[] = $good;
    }

    public function removeGood(Good $good) : void
    {
        $this->goods->removeElement($good);
    }

}