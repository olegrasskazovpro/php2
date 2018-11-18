<?php

namespace app\models\repositories;

use app\base\App;
use app\models\DataEntity;

abstract class Repository implements IRepository
{
	private $db;
	private $tableName;
	private $savedObject = [];

	public function __construct()
	{
		$this->db = static::getDb();
		$this->tableName = $this->getTableName();
	}

	public function find($sql, $params = [])
	{
		return static::getDb()->queryAll($sql, $params);
	}

	public function getOne($id)
	{
		$table = $this->tableName;
		$sql = "SELECT * FROM {$table} WHERE id = :id";
		$obj = static::getDb()->queryObj($sql, [':id' => $id], $this->getEntityClass())[0];
		try {
			$this->saveObject($obj);
		} catch (\Exception $e) {
			echo "Не удалось получить объект из БД";
		} finally{
			return $obj;
		}
	}

	public function getAll()
	{
		$table = $this->tableName;
		$sql = "SELECT * FROM {$table}";
		return static::getDb()->queryObj($sql, [], $this->getEntityClass());
	}

	public function delete(DataEntity $entity)
	{
		$table = $this->getTableName($entity);
		$sql = "DELETE FROM {$table} WHERE id = :id";
		$this->db->execute($sql, [':id' => $entity->id]);
	}

	public function insert(DataEntity $entity)
	{
		$columns = $this->getColumns($entity);
		$params = [];

		foreach ($entity as $key => $value) {
			foreach ($columns as $key2 => $value2) {
				if ($key == $value2) {
					$params[":{$key}"] = $value;
					$columns["{$key2}"] = "`{$value2}`";
				}
			}
		}

		$columns = implode(", ", $columns);
		$placeholders = implode(", ", array_keys($params));

		$sql = "INSERT INTO {$this->tableName} ({$columns}) VALUES ({$placeholders})";
		$this->db->execute($sql, $params);
		$entity->id = $this->db->lastInsertId();
	}

	public function update(DataEntity $entity)
	{
		$columns = [];
		$params = [':id' => "$entity->id"];

		foreach ($entity as $key => $value) {
			foreach ($this->savedObject as $key2 => $value2) {
				if ($key == $key2) {
					if ($value !== $value2) {
						$columns[] = "{$key} = :{$key}";
						$params[":{$key}"] = "{$value}";
					}
				}
			}
		}

		$columns = implode(", ", $columns);

		$sql = "UPDATE {$this->tableName} SET {$columns} WHERE id = :id";
		$this->db->execute($sql, $params);
	}

	public function save(DataEntity $entity)
	{
		if (is_null($entity->id)) {
			$this->insert($entity);
		} else {
			$this->update($entity);
		}
		$this->saveObject($entity); // обновляем savedObject
		return $entity;
	}

	private function saveObject($entity)
	{
		if ($entity instanceof DataEntity) {
			$columns = $this->getColumns();

			$objectProps = [];

			foreach ($entity as $key => $value) {
				foreach ($columns as $key2 => $value2) {
					if ($key == $value2) {
						$objectProps["{$key}"] = $value;
					}
				}
			}

			$this->savedObject = $objectProps;
		} else {
			throw new \Exception();
		}
	}

	public function getColumns()
	{
		$sql = "DESCRIBE {$this->tableName}";
		return $this->db->getColumns($sql);
	}

	private static function getDb()
	{
		return App::call()->db;
	}

	abstract public function getTableName();
}