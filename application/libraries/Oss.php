<?php
require_once 'oss/autoload.php';
use OSS\OssClient;
use OSS\Core\OssException;

class Oss{
	private $accessKeyId = 'LTAIYx4frWDru6Yt';
	private $accessKeySecret = 'SSoDb1RVVkHrR568b2054gsXnGk9dE';
	private $endpoint = 'oss-cn-shanghai.aliyuncs.com';
	private $bucket_public = 'mmpub';
	private $bucket_private = 'mmpvt';

	private $ossClient = null;

	function __construct()
	{
		try {
	    		$this->ossClient = new OssClient($this->accessKeyId, $this->accessKeySecret, $this->endpoint);
		} catch (OssException $e) {
	    		printf($e->getMessage()."\n");
			die();
		}
	}

	function uploadDir($prefix, $localDirectory)
	{
	    	try {
	        	$this->ossClient->uploadDir($this->bucket_public, $prefix, $localDirectory);
	    	}catch(OssException $e){
	        	printf($e->getMessage()."\n");
	        	return false;
	   	}
	    	return true;
	}

	function uploadFile($prefix, $localFile)
	{
	    	try {
	        	$this->ossClient->uploadFile($this->bucket_private, $prefix, $localFile);
	    	}catch(OssException $e){
	        	printf($e->getMessage()."\n");
	        	return false;
	   	}
	    	return true;
	}
}