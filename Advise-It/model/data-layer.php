<?php

//Require the database credentials
require_once $_SERVER['DOCUMENT_ROOT'].'/../pdo-config.php';

/**
 * Class DataLayer accesses data needed for the Diner app
 */
class DataLayer
{
    //Add a field to store the database connection object
    private $_dbh;

    //Define a default constructor
    //TODO: Add doc block
    function __construct()
    {
        try {
            //Instantiate a PDO database object
            $this->_dbh = new PDO (DB_DSN, DB_USERNAME, DB_PASSWORD);
            //echo "Yay!";
        }
        catch (PDOException $e) {
            echo "Error connecting to DB " . $e->getMessage();
        }
    }

    /**
     * saveOrder accepts an Order object and inserts it into the DB
     * @param $plan Plan Order object
     * @return string The order_id of the inserted row
     */
    function savePlan($plan)
    {
        //1. Define the query
        $sql = "INSERT INTO advise (token, fall, winter, spring, summer)
        VALUES (:token, :fall, :winter, :spring, :summer)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':token', $plan->getToken());
        $statement->bindParam(':fall', $plan->getFall());
        $statement->bindParam(':winter', $plan->getWinter());
        $statement->bindParam(':spring', $plan->getSpring());
        $statement->bindParam(':summer', $plan->getSummer());

        //4. Execute the query
        $statement->execute();

        //5. Process the results (get the primary key)
        return $this->_dbh->lastInsertId();

    }

    //TODO: Add docblock
    function getPlan()
    {
        //1. Define the query
        $sql = "SELECT * FROM diner_order";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the query
        $statement->execute();

        //5. Process the results (get the primary key)
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}