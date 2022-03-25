<?php

namespace App\Plugins\Marketing\Entity;

use App\Plugins\Common\Entity\BaseEntity;
use App\Plugins\Marketing\Repository\ActionRulesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActionRulesRepository::class)
 */
class ActionRules extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * #App\Field(inForm="inputHidden")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Action::class, inversedBy="actionRules")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $action;


    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $rule;

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
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action): void
    {
        $this->action = $action;
    }

    /**
     * @param mixed $rule
     */
    public function setRule($rule): void
    {
        $this->rule = $rule;
    }
}
