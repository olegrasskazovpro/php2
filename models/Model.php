<?php
/**
 * Created by PhpStorm.
 * User: olegrasskazov
 * Date: 13.10.2018
 * Time: 16:19
 */

namespace app\models;

abstract class Model implements IModel
{
	private $db;

	public function __construct(IDb $db)
	{
		$this->db = $db;
	}

	public function getOne($id)
	{
		$tableName = $this->getTableName();
		$sql = "SELECT * FROM {$tableName} WHERE id = {$id}";
		return $this->db->queryOne($sql);
	}

	public function getAll()
	{
		$tableName = $this->getTableName();
		$sql = "SELECT * FROM {$tableName}";
		return $this->db->queryOne($sql);
	}

	abstract public function getTableName();
}