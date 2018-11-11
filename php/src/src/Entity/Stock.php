<?php
/**
 * Created by PhpStorm.
 * User: remy
 * Date: 28/10/18
 * Time: 16:54
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var int
     */
    private $id;

    /**
     * One Stock has Many Entry.
     * @ORM\OneToMany(targetEntity="Entry", mappedBy="stock", cascade={"persist"})
     */
    private $entries;

    /**
     * One Stock has Many Withdrawals.
     * @ORM\OneToMany(targetEntity="Withdrawal", mappedBy="stock", cascade={"persist"})
     */
    private $withdrawals;


    public function __construct()
    {
        $this->entries = new ArrayCollection();
        $this->withdrawals = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEntries() : ArrayCollection
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

    public function getWithdrawals() : ArrayCollection
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
}