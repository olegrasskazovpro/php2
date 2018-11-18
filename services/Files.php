<?php

namespace app\services;


class Files
{
	private $config = [];

	public function __construct($imgDir)
	{
		$this->config['imgDir'] = $imgDir;
	}


	public function load($attr, $dir)
	{
		$dir = $this->config[$dir];

		if (isset($_FILES[$attr])) {
			$name = $_FILES[$attr]['name']; // имя файла картинки

			$files = scandir($dir);

			if ($this->findSame($files, $name)) {
				$name = $this->renameFile($files, $name);
			}

			$filename = $dir . $name;

			move_uploaded_file($_FILES[$attr]['tmp_name'], $filename);

			return $name;
		} else {
			return false;
		}
	}

	/**
	 * Function returns TRUE if folder (presented by $files array) contains file $name
	 * @param [] $files array of files in folder
	 * @param $name - name of file included file extension
	 * @return bool true if $name file exist in $files array
	 */
	private function findSame($files, $name)
	{
		foreach ($files as $value) {
			if ($value == $name) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Return new file name with postfix (_num) increasing it to 1
	 * @param [] $files - array of folder file names
	 * @param String $name - name of file that trying to add to folder
	 * @return string - new filename with postfix
	 */
	private function renameFile($files, $name)
	{
		$fileName = explode('.', $name)[0];
		$fileExtension = explode('.', $name)[1];

		$FFiles = $this->filterFiles($files, "/^$fileName\_\d+/");
		$_num = '_' . (count($FFiles) + 1);

		$newName = $fileName . $_num . ".$fileExtension";

		return $newName;
	}

	/**
	 * @param [] $files array of files in folder
	 * @param String $pattern regular expression pattern
	 * @return array of files
	 */
	private function filterFiles($files, $pattern)
	{
		return preg_grep($pattern, $files);
	}
}