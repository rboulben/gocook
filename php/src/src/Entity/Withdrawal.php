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
     * @ORM\ManyToOne(targetEntity="Good", inversedBy="withdrawals")
     * @ORM\JoinColumn(name="good_id", referencedColumnName="id")
     */
    private $good;

    /**
     * Many Withdrawal have One Stock.
     * @ORM\ManyToOne(targetEntity="Stock", inversedBy="withdrawals")
     * @ORM\JoinColumn(name="stock_id", referencedColumnName="id")
     */
    private $stock;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;
}