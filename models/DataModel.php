<?php
/**
 * Created by PhpStorm.
 * User: olegrasskazov
 * Date: 13.10.2018
 * Time: 16:19
 */

namespace app\models;

use app\interfaces\IModel;
use app\services\Db;

abstract class DataModel implements IModel
{
	private $db;
	private $tableName;
	private $savedObject = [];

	public function __construct()
	{
		$this->db = Db::getInstance();
		$this->tableName = static::getTableName();
		$this->saveObject();
		session_start();
	}

	public function saveObject()
	{
		$columns = $this->getColumns();

		$objectProps = [];

		foreach ($this as $key => $value) {
			foreach ($columns as $key2 => $value2) {
				if ($key == $value2) {
					$objectProps["{$key}"] = $value;
				}
			}
		}

		$this->savedObject = $objectProps;
	}

	public static function getOne($id)
	{
		$table = static::getTableName();
		$sql = "SELECT * FROM {$table} WHERE id = :id";
		return Db::getInstance()->queryObj($sql, [':id' => $id], get_called_class());
	}

	public static function getAll()
	{
		$table = static::getTableName();
		$sql = "SELECT * FROM {$table}";
		return Db::getInstance()->queryObjAll($sql, get_called_class());
	}

	public function delete()
	{
		$table = static::getTableName();
		$sql = "DELETE FROM {$table} WHERE id = :id";
		$this->db->execute($sql, [':id' => $this->id]);
	}

	public function insert()
	{
		$columns = $this->getColumns();
		$params = [];

		foreach ($this as $key => $value) {
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
		$this->id = $this->db->lastInsertId();
	}

	public function update()
	{
		$columns = [];
		$params = [':id' => "$this->id"];

		foreach ($this as $key => $value) {
			foreach ($this->savedObject as $key2 => $value2) {
				if ($key == $key2) {
					if ($this->savedObject["$key"] !== $value) {
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

	public function save()
	{
		if (is_null($this->id)){
			$this->insert();
		} else {
			$this->update();
		}
		$this->saveObject(); // обновляем savedObject
	}

	public function getColumns()
	{
		$sql = "DESCRIBE {$this->tableName}";
		return $this->db->getColumns($sql);
	}

	abstract static public function getTableName();
}
