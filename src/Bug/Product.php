<?php

namespace Bug;

class Product
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName(string $name): Product
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }


}
