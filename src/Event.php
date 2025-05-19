<?php

namespace App;

use SQLite3;

class Event
{
    private SQLite3 $db;

    public function __construct(SQLite3 $db)
    {
        $this->db = $db;
    }

    public function insert(string $type)
    {
        $created = time();
        $query = 'INSERT INTO `Event` (`type`, `created`) 
                  VALUES("' . $type . '", "' . date('Y-m-d H:i:s', $created) . '")';
        return $this->db->exec($query);
    }

    public function getEventsCount(string $dateFrom, string $dateTo)
    {
        $query = 'SELECT COUNT(*) FROM `Event` WHERE DATE(`created`) BETWEEN :from AND :to';
        $prepared = $this->db->prepare($query);
        $prepared->bindParam(':from', $dateFrom);
        $prepared->bindParam(':to', $dateTo);
        return $this->db->querySingle($prepared->getSQL(true));
    }

    public function getTypesStats()
    {
        $query = 'SELECT `type`, COUNT() as `cnt`, `created` FROM `Event` GROUP BY `type`';
        $results = [];
        $dbResults = $this->db->query($query);
        while ($row = $dbResults->fetchArray(SQLITE3_ASSOC)) {
            $results[$row['type']] = $row['cnt'];
        }
        return $results;
    }
}
