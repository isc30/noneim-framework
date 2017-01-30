<?php

/**
 * PDO Extension
 */
class PDOExtension extends PDO {

    /**
     * PDOExtension Constructor
     * @throws DatabaseConnectionException
     */
    public function __construct()
    {
        try
        {
            if(DatabaseConfiguration::$customPort !== null)
            {
                @parent::__construct(DatabaseConfiguration::$type . ':host=' . DatabaseConfiguration::$host . ':port=' . DatabaseConfiguration::$customPort . ';dbname=' . DatabaseConfiguration::$database . ';charset=' . DatabaseConfiguration::$charset, DatabaseConfiguration::$username, DatabaseConfiguration::$password, array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DatabaseConfiguration::$charset,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_PERSISTENT => DatabaseConfiguration::$persistentConnection,
                ));
            }
            else
            {
                @parent::__construct(DatabaseConfiguration::$type . ':host=' . DatabaseConfiguration::$host . ';dbname=' . DatabaseConfiguration::$database . ';charset=' . DatabaseConfiguration::$charset, DatabaseConfiguration::$username, DatabaseConfiguration::$password, array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DatabaseConfiguration::$charset,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_PERSISTENT => DatabaseConfiguration::$persistentConnection,
                ));
            }
        }
        catch (Exception $ex)
        {
            if (RuntimeConfiguration::$debug)
            {
                throw new DatabaseConnectionException($ex->getMessage());
            }
            else
            {
                throw new DatabaseConnectionException();
            }
        }
    }
    
    public function callProcedure($prName, $params) {
        
        $result = array();

        // Set the values to the INOUT params
        foreach ($params as $param) {
            if ($param->behavior === SqlParameter::INOUT) {
                $query = $this->prepare("SET @o_{$param->name} = :value");
                $query->bindValue(':value', $param->value, $param->type);
                $query->execute();
                $query->closeCursor();
            }
        }

        // Generate the procedure parameters :S
        $procParams = array();
        foreach ($params as $param) {
            $procParams[] = ($param->behavior === SqlParameter::IN ? ':' : '@o_') . $param->name;
        }

        // Prepare the calling
        $query = $this->prepare("CALL `{$prName}` (" . implode(',', $procParams) . ')');
        foreach ($params as $param) {
            if ($param->behavior === SqlParameter::IN) {
                $query->bindParam(":{$param->name}", $param->value, $param->type);
            }
        }
        $query->execute(); // Execute the query

        // Fetch all the selects into the procedure
        $result['pr'] = array();
        while ($query->columnCount() > 0) {
            $result['pr'][] = $query->fetchAll(PDO::FETCH_ASSOC);
            $query->nextRowset();
        }
        $query->closeCursor();

        // Generate the output parameters
        $procParams = array();
        foreach ($params as $param) {
            if ($param->behavior !== SqlParameter::IN) {
                $procParams[] = "@o_{$param->name} as {$param->name}";
            }
        }

        $result['out'] = array();
        if (count($procParams) > 0) {
            // Fetch the INOUT and OUT parameters
            $query = $this->query('SELECT ' . implode(',', $procParams));
            $result['out'] = $query->fetch(PDO::FETCH_ASSOC);
            $query->closeCursor();
        }

        return $result;
        
    }

    public function callFunction($fuName, $params) {

        // Generate the function parameters :S
        $funcParams = array();
        foreach ($params as $param) {
            $funcParams[] = ":{$param->name}";
        }

        // Prepare the calling
        $query = $this->prepare("SELECT `{$fuName}` (" . implode(',', $funcParams) . ') as output');
        foreach ($params as $param) {
            $query->bindParam(":{$param->name}", $param->value, $param->type);
        }
        $query->execute(); // Execute the query

        $result = $query->fetch(PDO::FETCH_NUM);
        $result = $result[0];
        $query->closeCursor();

        return $result;

    }
    
}