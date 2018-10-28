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
class Ingredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Many Ingredient have One Recipe.
     * @ORM\ManyToOne(targetEntity="Recipe", inversedBy="ingredients")
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id")
     */
    private $recipe;

    /**
     * Many Ingredient have One Good.
     * @ORM\ManyToOne(targetEntity="Good", inversedBy="ingredients")
     * @ORM\JoinColumn(name="good_id", referencedColumnName="id")
     */
    private $goods;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;
}