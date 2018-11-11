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
class Withdrawal
{
    /**
     * @var int
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
     * Many Withdrawal have One Good.
     * @var Good
     * @ORM\ManyToOne(targetEntity="Good", inversedBy="withdrawals")
     * @ORM\JoinColumn(name="good_id", referencedColumnName="id")
     */
    private $good;

    /**
     * Many Withdrawal have One Stock.
     * @var Stock
     * @ORM\ManyToOne(targetEntity="Stock", inversedBy="withdrawals")
     * @ORM\JoinColumn(name="stock_id", referencedColumnName="id")
     */
    private $stock;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $quantity;


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

    public function setStock(Stock $stock): voidQ
    {
        $this->stock = $stock;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

}