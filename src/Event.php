<?php declare(strict_types=1);

namespace App;

use SQLite3;

class Event
{
    private SQLite3 $db;

    public function __construct(SQLite3 $db)
    {
        $this->db = $db;
    }

    public function insert(string $type): void
    {
        $created = date('Y-m-d H:i:s');
		$query = 'INSERT INTO `Event` (`type`, `created`) VALUES (:type, :created)';
		$prepared = $this->db->prepare($query);
		$prepared->bindValue(':type', $type);
		$prepared->bindValue(':created', $created);

		$prepared->execute();
    }

    public function getEventsCount(string $dateFrom, string $dateTo): int
    {
        $query = 'SELECT COUNT(*) as `event_count` FROM `Event`
                 	WHERE DATE(`created`) BETWEEN :from AND :to';
        $prepared = $this->db->prepare($query);
        $prepared->bindValue(':from', $dateFrom);
        $prepared->bindValue(':to', $dateTo);
		$dbResult = $prepared->execute();
		$row = $dbResult->fetchArray(SQLITE3_ASSOC);

		return (int) $row['event_count'];
    }

	/**
	 * @return array<string, int>
	 */
	public function getTypesStats(): array
    {
        $query = 'SELECT `type`, COUNT(`type`) as `type_count` FROM `Event` GROUP BY `type`';
        $results = [];
        $dbResults = $this->db->query($query);

        while ($row = $dbResults->fetchArray(SQLITE3_ASSOC)) {
            $results[$row['type']] = (int) $row['type_count'];
        }

        return $results;
    }
}
