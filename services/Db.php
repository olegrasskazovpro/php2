<?php
/**
 * Created by PhpStorm.
 * User: olegrasskazov
 * Date: 13.10.2018
 * Time: 15:53
 */

namespace app\services;

use app\interfaces\IDb;
use app\traits\TSingleton;

class Db implements IDb
{
	use TSingleton;

	private $config = [
		'driver' => 'mysql',
		'host' => 'localhost',
		'login' => 'root',
		'password' => 'root',
		'database' => 'shop',
		'charset' => 'utf8mb4',
	];

	protected $conn = null;

	protected function getConnection()
	{
		if (is_null($this->conn)) {
			$this->conn = new \PDO(
				$this->prepareDnsString(),
				$this->config['login'],
				$this->config['password']
			);
			$this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
		}
		return $this->conn;
	}

	private function query($sql, $params = [])
	{
		$pdoStatement = $this->getConnection()->prepare($sql);
		$pdoStatement->execute($params);
		if ($pdoStatement->errorInfo()[0] !== '00000') {
			var_dump($pdoStatement->errorInfo());
		}
		return $pdoStatement;
	}

	public function lastInsertId() : int
	{
		return $this->getConnection()->lastInsertId();
	}

	public function getColumns($sql, $params = [])
	{
		return $this->query($sql, $params)->fetchAll(\PDO::FETCH_COLUMN);
	}

	public function execute(string $sql, array $params = [])
	{
		return $this->query($sql, $params);
	}

	public function queryOne(string $sql, array $params = [])
	{
		return $this->queryAll($sql, $params)[0];
	}

	public function queryAll(string $sql, array $params = [])
	{
		return $this->query($sql, $params)->fetchAll();
	}

	public function queryObj($sql, $params = [], $class)
	{
		$smtp = $this->query($sql, $params);
		$smtp->setFetchMode(\PDO::FETCH_CLASS, $class);
		return $smtp->fetch();
	}

	public function queryObjAll($sql, $class)
	{
		$smtp = $this->query($sql);
		$smtp->setFetchMode(\PDO::FETCH_CLASS, $class);
		return $smtp->fetchAll();
	}

	private function prepareDnsString(): string
	{
		return sprintf("%s:host=%s;dbname=%s;charset=%s",
			$this->config['driver'],
			$this->config['host'],
			$this->config['database'],
			$this->config['charset']
		);
	}
}