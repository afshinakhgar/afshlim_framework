<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/24/17
 * Time: 1:11 PM
 */

namespace Core\Services;

use Core\Interfaces\_Service;
use Slim\Http\UploadedFile;

class File extends _Service
{
	public function moveUploadedFile($directory,$fileName, UploadedFile $uploadedFile)
	{
	    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
	    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
	    $filename = sprintf('%s.%0.8s', $fileName, $extension);
	    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
	    return $filename;
	}

}