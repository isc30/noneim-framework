<?php

class ConnectionContainer implements IConnectionContainer
{
    /** @var PDOExtension */
    private $PDO;
    
    /**
     * Return PDO
     * @return PDOExtension
     */
    public function PDO()
    {
        if ($this->PDO === null)
        {
            $this->PDO = new PDOExtension();
        }
        
        return $this->PDO;
    }
}