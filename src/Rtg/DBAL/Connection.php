<?php

namespace Rtg\DBAL;

use Doctrine\DBAL\Connection as DBALConnection;

/**
 * Extension for Doctrine DBAL Connection to add some missing functionality
 *
 * @package BI\DataBundle\DBAL
 */
class Connection extends DBALConnection
{
    /**
     * Returns first row
     *
     * @param $statement
     * @param array $params
     * @return array
     */
    public function fetchRow($statement, array $params = array())
    {
        return $this->executeQuery($statement, $params)->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Fetches all rows of first column
     *
     * @param $statement
     * @param array $params
     * @return array
     */
    public function fetchCompleteColumn($statement, array $params = array())
    {
        $statement = $this->executeQuery($statement, $params);
        $result = array();
        while (($row = $statement->fetch(\PDO::FETCH_NUM)) !== false) {
            $result[] = $row[0];
        }
        return $result;
    }

    /**
     * Fetches first column of first row
     *
     * @param $statement
     * @param array $params
     * @return mixed
     */
    public function fetchOne($statement, array $params = array())
    {
        return $this->fetchColumn($statement, $params);
    }

    /**
     * Fetches all rows of first two columns as key => value pairs
     *
     * @param $statement
     * @param array $params
     * @return array
     */
    public function fetchKeyValue($statement, array $params = array())
    {
        $statement = $this->executeQuery($statement, $params);
        $result = array();
        while (($row = $statement->fetch(\PDO::FETCH_NUM)) !== false) {
            $result[$row[0]] = $row[1];
        }
        return $result;
    }
}