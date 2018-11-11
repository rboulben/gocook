<?php
/**
 * Created by PhpStorm.
 * User: remy
 * Date: 28/10/18
 * Time: 15:47
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $difficulty;

    /**
     * One Recipe has Many Ingredients.
     * @ORM\OneToMany(targetEntity="Ingredient", mappedBy="recipe", cascade={"persist"})
     */
    private $ingredients;

    /**
     * @ORM\Column(type="array")
     * TODO this
     */
    private $history;

    public function __construct()
    {
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getScore()
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDifficulty()
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): void
    {
        $this->difficulty = $difficulty;
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