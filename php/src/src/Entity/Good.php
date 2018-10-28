<?php
/**
 * Created by PhpStorm.
 * User: remy
 * Date: 28/10/18
 * Time: 16:20
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 */
class Good
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
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="goods")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $durabilityDays;

    /**
     * @ORM\Column(type="string", length=25)
     * TODO maybe typing
     */
    private $unit;

    /**
     * One Product has Many Ingredients.
     * @ORM\OneToMany(targetEntity="Ingredient", mappedBy="goods")
     */
    private $ingredients;

    /**
     * One Good has Many Entries.
     * @ORM\OneToMany(targetEntity="Entry", mappedBy="good")
     */
    private $entries;

    /**
     * One Good has Many Withdrawals.
     * @ORM\OneToMany(targetEntity="Withdrawal", mappedBy="good")
     */
    private $withdrawals;

    /**
     * @var integer
     * Quantity in unit/day, removed from the stock
     * @ORM\Column(type="integer")
     */
    private $dailyConsomption = 0;



    public function __construct()
    {
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
    }


}