<?php

namespace app\models\repositories;
use app\services\Db;
use app\models\DataEntity;

abstract class Repository implements IRepository
{
	private $db;
	private $tableName;
	private $savedObject = [];

	public function __construct()
	{
		$this->db = static::getDv();
		$this->tableName = $this->getTableName();
	}

	public function saveObject(DataEntity $entity)
	{
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
	}

	public function getOne($id)
	{
		$table = $this->tableName;
		$sql = "SELECT * FROM {$table} WHERE id = :id";
		$obj = static::getDv()->queryObj($sql, [':id' => $id], $this->getEntityClass());
		$this->saveObject($obj);
		return $obj;
	}

	public function getAll()
	{
		$table = $this->tableName;
		$sql = "SELECT * FROM {$table}";
		return static::getDv()->queryObjAll($sql, $this->getEntityClass());
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
		$params = [':id' => "$this->id"];

		foreach ($entity as $key => $value) {
			foreach ($entity->savedObject as $key2 => $value2) {
				if ($key == $key2) {
					if ($entity->savedObject["$key"] !== $value) {
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
		if (is_null($entity->id)){
			$this->insert($entity);
		} else {
			$this->update($entity);
		}
		$this->saveObject($entity); // обновляем savedObject
	}

	public function getColumns()
	{
		$sql = "DESCRIBE {$this->tableName}";
		return $this->db->getColumns($sql);
	}

	private static function getDv()
	{
		return Db::getInstance();
	}

	abstract public function getTableName();
}