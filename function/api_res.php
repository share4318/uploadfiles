<?php
include_once 'fileupload.class.php';

class JsonFormat
{
	public $data;
	public $html;
	public $rows;
	public $OKitems=array();
}

$action=isset($_GET['act'])?$_GET['act']:null;
switch ($action)
{	
    case "upload":
		$file=isset($_FILES["file"])?$_FILES["file"]:null;

		$up=new FileUpload;
		$r=null;
		
		$isupdated=$up->upload($file);
		$r.=$isupdated?"[<font style='color:green'>信息</font>]: [".$up->getFileName()."]上传成功!<br>":$up->getErrorMsg();
		
		$res=new JsonFormat;
		$res->html=$r;
		$res->data=$isupdated;
		
		ob_clean();
		header('Content-type:application/json');
		print(json_encode($res, JSON_FORCE_OBJECT));
	break;
}
