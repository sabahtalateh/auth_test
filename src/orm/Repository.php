<?php

namespace app\orm;

use app\model\Model;
use PDO;

class Repository
{
    private $dbHost = 'db';
    private $dbName = 'authdb';
    private $dbUser = 'authdb';
    private $dbPassword = 'authdb';

    private static $INSTANCE = null;

    /**
     * @return Repository
     */
    public static function getInstance(): Repository
    {
        if (null === self::$INSTANCE) {
            self::$INSTANCE = new Repository();
        }

        return self::$INSTANCE;
    }

    /**
     * Repository constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param Model $model
     *
     * @return Model
     * @throws \Exception
     */
    public function save(Model $model)
    {
        $fields = get_object_vars($model);

        $fieldsNamesForSqlQuery = [];
        $fieldsValuesForSqlQuery = [];
        $questionMarks = "";

        foreach ($fields as $fieldName => $fieldValue) {
            if (null !== $fieldValue) {
                $fieldsNamesForSqlQuery[] = $this->camelCaseToSnakeCase($fieldName);
                $fieldsValuesForSqlQuery[] = $fieldValue;
                $questionMarks .= "?,";
            }
        }

        if (strlen($questionMarks) > 0) {
            // remove last "," symbol.
            $questionMarks = substr($questionMarks, 0, strlen($questionMarks) - 1);
        }

        if (count($fieldsNamesForSqlQuery) > 0) {
            $connection = new PDO(
                "pgsql:host={$this->dbHost};dbname={$this->dbName}",
                $this->dbUser,
                $this->dbPassword
            );

            $fieldsNamesString = implode(",", $fieldsNamesForSqlQuery);
            $sql = "INSERT INTO {$model->getTable()} ({$fieldsNamesString}) VALUES ($questionMarks)";

            $statement = $connection->prepare($sql);
            for ($i = 0; $i < count($fieldsValuesForSqlQuery); $i++) {
                $statement->bindValue($i + 1, $fieldsValuesForSqlQuery[$i]);
            }
            $queryResult = $statement->execute();

            if (false !== $queryResult) {
                $model->id = $connection->lastInsertId();

                return $model;
            } else {
                throw new \Exception("There are some errors occurred during the entity persistence.");
            }
        }
    }

    /**
     * @param string $input
     *
     * @return string
     */
    function camelCaseToSnakeCase(string $input): string
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode('_', $ret);
    }
}