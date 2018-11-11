<?php
/**
 * Created by PhpStorm.
 * User: remy
 * Date: 28/10/18
 * Time: 16:55
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 */
class Entry
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
     * Many Entry have One Good.
     * @ORM\ManyToOne(targetEntity="Good", inversedBy="entries")
     * @ORM\JoinColumn(name="good_id", referencedColumnName="id")
     */
    private $good;

    /**
     * Many Entry have One Stock.
     * @ORM\ManyToOne(targetEntity="Stock", inversedBy="entries")
     * @ORM\JoinColumn(name="stock_id", referencedColumnName="id")
     */
    private $stock;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer")
     */
    private $consomedQuantity;


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

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getConsomedQuantity()
    {
        return $this->consomedQuantity;
    }

    public function setConsomedQuantity(int $consomedQuantity): void
    {
        $this->consomedQuantity = $consomedQuantity;
    }

    public function getGood()
    {
        return $this->good;
    }

    public function setGood(Good $good): void
    {
        $this->good = $good;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock(Stock $stock): void
    {
        $this->stock = $stock;
    }

}