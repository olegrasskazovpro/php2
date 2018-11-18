<?php

namespace app\models;

class User extends DataEntity
{
	public $id;
	public $login;
	public $name;
	public $password;
}