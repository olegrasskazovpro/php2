<?php

namespace app\services;

class Db implements IDb
{
	private $config = [];

	protected $conn = null;

	public function __construct($driver, $host, $login, $password, $database, $charset = 'utf8mb4')
	{
		$this->config['driver'] = $driver;
		$this->config['host'] = $host;
		$this->config['login'] = $login;
		$this->config['password'] = $password;
		$this->config['database'] = $database;
		$this->config['charset'] = $charset;
	}

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