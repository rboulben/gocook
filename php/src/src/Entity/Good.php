<?php
/**
 * Created by PhpStorm.
 * User: remy
 * Date: 28/10/18
 * Time: 16:20
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GoodRepository")
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
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     * @Assert\NotBlank(groups={"Create"})
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $durabilityDays;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $unit;

    /**
     * One Product has Many Ingredients.
     * @ORM\OneToMany(targetEntity="Ingredient", mappedBy="good", cascade={"persist"})
     */
    private $ingredients;

    /**
     * One Good has Many Entries.
     * @ORM\OneToMany(targetEntity="Entry", mappedBy="good", cascade={"persist"})
     */
    private $entries;

    /**
     * One Good has Many Withdrawals.
     * @ORM\OneToMany(targetEntity="Withdrawal", mappedBy="good", cascade={"persist"})
     */
    private $withdrawals;

    /**
     * @var integer
     * Quantity in unit/day, removed from the stock
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dailyConsomption = 0;



    public function __construct()
    {
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
        $this->entries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->withdrawals = new \Doctrine\Common\Collections\ArrayCollection();

    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDurabilityDays()
    {
        return $this->durabilityDays;
    }

    public function setDurabilityDays(int $durabilityDays): void
    {
        $this->durabilityDays = $durabilityDays;
    }

    public function getUnit()
    {
        return $this->unit;
    }

    public function setUnit($unit): void
    {
        $this->unit = $unit;
    }

    public function getDailyConsomption()
    {
        return $this->dailyConsomption;
    }

    public function setDailyConsomption(int $dailyConsomption): void
    {
        $this->dailyConsomption = $dailyConsomption;
    }

    public function getEntries()
    {
        return $this->entries;
    }

    public function setEntries($entries): void
    {
        $this->entries = $entries;
    }

    public function addEntry(Entry $entry) : void
    {
        if ($this->entries->contains($entry)) {
            return;
        }
        $this->entries[] = $entry;
    }

    public function removeEntry(Entry $entry) : void
    {
        $this->entries->removeElement($entry);
    }

    public function getWithdrawals()
    {
        return $this->withdrawals;
    }

    public function setWithdrawals(ArrayCollection $withdrawals): void
    {
        $this->withdrawals = $withdrawals;
    }

    public function addWithdrawal(Withdrawal $withdrawal) : void
    {
        if ($this->withdrawals->contains($withdrawal)) {
            return;
        }
        $this->withdrawals[] = $withdrawal;
    }

    public function removeWithdrawal(Withdrawal $withdrawal) : void
    {
        $this->withdrawals->removeElement($withdrawal);
    }

    public function getIngredients()
    {
        return $this->ingredients;
    }

    public function setIngredients(ArrayCollection $ingredients): void
    {
        $this->ingredients = $ingredients;
    }

    public function addIngredient(Ingredient $ingredient) : void
    {
        if ($this->ingredients->contains($ingredient)) {
            return;
        }
        $this->ingredients[] = $ingredient;
    }

    public function removeIngredient(Ingredient $ingredient) : void
    {
        $this->ingredients->removeElement($ingredient);
    }
    

}