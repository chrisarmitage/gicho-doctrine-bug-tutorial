<?php

namespace Bug;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bugs")
 */
class Bug
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $created;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $status;

    public function id()
    {
        return $this->id;
    }

    public function description()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }

    public function created()
    {
        return $this->created;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function status()
    {
        return $this->status;
    }

    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    private $engineer;
    private $reporter;

    public function setEngineer(User $engineer)
    {
        $engineer->assignedToBug($this);
        $this->engineer = $engineer;
    }

    public function setReporter(User $reporter)
    {
        $reporter->addReportedBug($this);
        $this->reporter = $reporter;
    }

    public function engineer(): User
    {
        return $this->engineer;
    }

    public function reporter()
    {
        return $this->reporter;
    }

    public function assignToProduct(Product $product)
    {
        $this->products[] = $product;
    }

    /**
     * @return Product[]
     */
    public function products()
    {
        return $this->products;
    }

    public function close()
    {
        $this->status = "CLOSE";
    }
}
