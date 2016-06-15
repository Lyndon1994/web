<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Util extends CI_Controller {
	
	public function index()
	{
	}
	public function upload()
	{
		$targetDir = 'source/images/upload_tmp';
		$uploadDir = 'source/images/upload';
		$maxFileAge = 1000;
		$cleanupTargetDir = true;


		if (!file_exists($targetDir)) {
			@mkdir($targetDir);
		}

		if (!file_exists($uploadDir)) {
			@mkdir($uploadDir);
		}

		if (isset($_REQUEST["name"])) {
			$fileName = $_REQUEST["name"];
		} elseif (!empty($_FILES)) {
			$fileName = $_FILES["wangEditorH5File"]["name"];
		} else {
			$fileName = uniqid("file_");
		}
		$fileName = iconv('UTF-8', 'GB2312', $fileName);
		$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
		$uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;


		$imgUrl = "/" . $uploadDir . "/" . $fileName;
		echo $imgUrl;

		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;


		if ($cleanupTargetDir) {
			if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}

			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

				if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
					continue;
				}

				if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);
		}


		if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}

		if (!empty($_FILES)) {
			if ($_FILES["wangEditorH5File"]["error"] || !is_uploaded_file($_FILES["wangEditorH5File"]["tmp_name"])) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
			}

			if (!$in = @fopen($_FILES["wangEditorH5File"]["tmp_name"], "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		} else {
			if (!$in = @fopen("php://input", "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		}

		while ($buff = fread($in, 4096)) {
			fwrite($out, $buff);
		}

		@fclose($out);
		@fclose($in);

		rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");

		$index = 0;
		$done = true;
		for ($index = 0; $index < $chunks; $index++) {
			if (!file_exists("{$filePath}_{$index}.part")) {
				$done = false;
				break;
			}
		}
		if ($done) {
			if (!$out = @fopen($uploadPath, "wb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
			}

			if (flock($out, LOCK_EX)) {
				for ($index = 0; $index < $chunks; $index++) {
					if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
						break;
					}

					while ($buff = fread($in, 4096)) {
						fwrite($out, $buff);
					}

					@fclose($in);
					@unlink("{$filePath}_{$index}.part");
				}

				flock($out, LOCK_UN);
			}
			@fclose($out);
		}
	}
}
