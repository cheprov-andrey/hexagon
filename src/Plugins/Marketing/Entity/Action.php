<?php

namespace App\Plugins\Marketing\Entity;

use App\Plugins\Common\Entity\BaseEntity;
use App\Plugins\Product\Entity\Product;
use App\Plugins\Marketing\Entity\ActionRules;
use App\Plugins\Marketing\Repository\ActionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActionRepository::class)
 */
class Action extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * #App\Field(inForm="inputHidden")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $aboutAction;

    /**
     * @ORM\Column(type="integer", length=255, nullable=false)
     */
    private $typeDiscount;

    /**
     * @ORM\Column(type="integer", length=255, nullable=false)
     */
    private $weightDiscount;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="actions")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity=ActionRules::class, mappedBy="action")
     */
    private $actionRules;

    /**
     * @ORM\Column(type="integer", length=255, nullable=false)
     */
    private $dateStart;

    /**
     * @ORM\Column(type="integer", length=255, nullable=false)
     */
    private $dateEnd;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAboutAction()
    {
        return $this->aboutAction;
    }

    /**
     * @return mixed
     */
    public function getTypeDiscount()
    {
        return $this->typeDiscount;
    }

    /**
     * @return mixed
     */
    public function getWeightDiscount()
    {
        return $this->weightDiscount;
    }

    /**
     * @return mixed
     */
    public function getActionProducts()
    {
        return $this->products;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return mixed
     */
    public function getActionRules()
    {
        return $this->actionRules;
    }

    /**
     * @return mixed
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $aboutAction
     */
    public function setAboutAction($aboutAction): void
    {
        $this->aboutAction = $aboutAction;
    }

    /**
     * @param mixed $typeDiscount
     */
    public function setTypeDiscount($typeDiscount): void
    {
        $this->typeDiscount = $typeDiscount;
    }

    /**
     * @param mixed $weightDiscount
     */
    public function setWeightDiscount($weightDiscount): void
    {
        $this->weightDiscount = $weightDiscount;
    }

    /**
     * @param mixed $actionProducts
     */
    public function setActionProducts($actionProducts): void
    {
        $this->products = $actionProducts;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products): void
    {
        $this->products = $products;
    }

    /**
     * @param mixed $actionRules
     */
    public function setActionRules($actionRules): void
    {
        $this->actionRules = $actionRules;
    }

    /**
     * @param mixed $dateStart
     */
    public function setDateStart($dateStart): void
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @param mixed $dateEnd
     */
    public function setDateEnd($dateEnd): void
    {
        $this->dateEnd = $dateEnd;
    }
}
