<?php

class FileController {
 

    public function __construct() {
        
    }
	//#############################################################
    public function getFile($fileId = null) {

    }
	//#############################################################
    public function uploadFile() 
	{
		$upload_dir = '../uploads/';  // directory form index.php
		if($_FILES['avatar'])
		{
		    $avatar_name = $_FILES["avatar"]["name"];
		    $avatar_tmp_name = $_FILES["avatar"]["tmp_name"];
		    $error = $_FILES["avatar"]["error"];

		    if($error > 0)
			{
        		echo json_encode(['Status' => 'ERROR' , 'Message' => 'Error uploading the file']);
	    	}
			else 
			{		
		        $random_name = rand(1000,1000000)."-".$avatar_name;
		        $upload_name = $upload_dir.strtolower($random_name);
    		    $upload_name = preg_replace('/\s+/', '-', $upload_name);
            	if(move_uploaded_file($avatar_tmp_name , $upload_name))
				{
	            	echo json_encode(['Status' => 'OK' , 'Message' => 'File Upload OK' , 'url' => $random_name]);
      			}
				else
        		{
					echo json_encode(['Status' => 'ERROR' , 'Message' => 'Error uploading the file']);
        		}
			}
    	}
		else
		{
	    	echo json_encode(['Status' => 'ERROR' , 'Message' => 'No File To Upload']);
		}

	}
	//##################################################################
    public function GetMoviesPhotoNames()
	{
		$FilesArray = array();
		$upload_dir = '../uploads/'; 
		if (is_dir($upload_dir))
		{
  			if ($dh = opendir($upload_dir))
			{
    			while (($file = readdir($dh)) !== false)
				{
					array_push($FilesArray,$file );
				}
    			closedir($dh);
  			}
			  array_shift($FilesArray);  // remove .
			  array_shift($FilesArray);  // rtemove ..
			  echo json_encode(['Status' => 'OK' , 'Message' => 'File Names Get  OK' , 'Data' => $FilesArray]);
		}

	}
}
?>
