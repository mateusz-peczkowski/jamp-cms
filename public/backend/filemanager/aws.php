<?php

require '../../../bootstrap/autoload.php';
$app = require_once  '../../../bootstrap/start.php';

function aws_get_instance()
{
	return Aws\S3\S3Client::factory(array(
 		'key' => getenv('AWS_KEY'),
 		'secret' => getenv('AWS_SECRET'),
	));
}

function aws_get_bucket()
{
	return $bucket = getenv('AWS_BUCKET');
}

function aws_get_bucket_path($targetFile)
{
	return $bucket_file_path = str_replace('../../source', 'upload', $targetFile);
}

function aws_get_local_path($targetFile)
{
	return $file_path = public_path() . str_replace('../..', '', $targetFile);
}

function aws_upload_file($targetFile)
{
	$s3 = aws_get_instance();

	$s3->putObject(array(
	    'Bucket'     => aws_get_bucket(),
	    'Key'        => aws_get_bucket_path($targetFile),
	    'SourceFile' =>  aws_get_local_path($targetFile),
	));
}

function aws_delete_file($targetFile)
{
	$s3 = aws_get_instance();

	$s3->deleteObject(array(
	    'Bucket' => aws_get_bucket(),
	    'Key'    => aws_get_bucket_path($targetFile),
	));  
}

function aws_sync_aws_to_local()
{
	$s3 = aws_get_instance();
	$s3->downloadBucket(public_path() . '/source', aws_get_bucket() . '/upload');
}

function aws_sync_local_to_aws()
{
	$s3 = aws_get_instance();
	$s3->uploadDirectory(public_path() . '/source', aws_get_bucket() . '/upload');
}

?>