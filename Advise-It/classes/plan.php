<?php

/**
 * Plan class represents the plan for a student with a unique token
 */
class Plan
{
    private $_token;
    private $_fall;
    private $_winter;
    private $_spring;
    private $_summer;

    /**
     * Order constructor.
     * $order = new Order();
     * $order = new Order("taco", "lunch", "salsa");
     * @param string $fall
     * @param string $winter
     * @param string $spring
     * @param string $summer
     * @throws Exception
     */
    public function __construct(string $fall = "", string $winter = "", string $spring = "", string $summer = "")
    {
        $this->_token = strtoupper(bin2hex(random_bytes(3)));
        $this->_fall = $fall;
        $this->_winter = $winter;
        $this->_spring = $spring;
        $this->_summer = $summer;
        echo $this->_token;
    }

    public function getToken(): string
    {
        return $this->_token;
    }

    /**
     * Set token
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->_token = $token;
    }

    /**
     * Return fall classes
     * @return string
     */
    public function getFall(): string
    {
        return $this->_fall;
    }

    /**
     * Set fall classes
     * @param string $fall
     */
    public function setFall(string $fall)
    {
        $this->_fall = $fall;
    }

    /**
     * Return winter classes
     * @return string
     */
    public function getWinter(): string
    {
        return $this->_winter;
    }

    /**
     * Set winter classes
     * @param string $winter
     */
    public function setWinter(string $winter)
    {
        $this->_winter = $winter;
    }

    /**
     * Return spring classes
     * @return string
     */
    public function getSpring(): string
    {
        return $this->_spring;
    }

    /**
     * Set spring classes
     * @param string $spring
     */
    public function setSpring(string $spring)
    {
        $this->_spring = $spring;
    }

    /**
     * Return summer classes
     * @return string
     */
    public function getSummer(): string
    {
        return $this->_summer;
    }

    /**
     * Set summer classes
     * @param string $summer
     */
    public function setSummer(string $summer)
    {
        $this->_summer = $summer;
    }
}