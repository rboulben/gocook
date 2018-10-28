<?php
/**
 * Created by PhpStorm.
 * User: remy
 * Date: 28/10/18
 * Time: 16:54
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 */
class Stock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * One Stock has Many Entry.
     * @ORM\OneToMany(targetEntity="Entry", mappedBy="stock")
     */
    private $entries;

    /**
     * One Stock has Many Withdrawals.
     * @ORM\OneToMany(targetEntity="Withdrawal", mappedBy="stock")
     */
    private $withdrawals;
}