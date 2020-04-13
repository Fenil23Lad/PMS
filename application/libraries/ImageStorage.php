<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class ImageStorage {

    
    //================ INSERT IMAGE IN FOLDER =============
    
    /* 
       PARAMETER REQUIRED:
     * PARAM 1:FOLDER PATH
     * PARAM 2:IMAGE CONTROL NAME
    */
    
    public function InsertImage($pathToUpload,$name)
    {  
        if(isset($_FILES[$name]))
        {
            if ( ! file_exists(FCPATH.$pathToUpload))
            {
                $create = mkdir(FCPATH.$pathToUpload,0777,TRUE);
                if ( ! $create)
                return '';
            }

            $newFileName=  $this->RenameImage($_FILES[$name]['name']);

            if(move_uploaded_file(realpath($_FILES[$name]['tmp_name']),$pathToUpload.$newFileName))
            {
                return $newFileName;
            }
            else
            {
                return '';
            }
        }
        else
        {
            return '';
        }
    }
    
    //================ UPDATE IMAGE IN FOLDER =============
    
    /* 
       PARAMETER REQUIRED:
     * PARAM 1:FOLDER PATH
     * PARAM 2:OLD IMAGE NAME
     * PARAM 3:NEW IMAGE NAME
    */
    public function UpdateImage($Path,$OldImage,$NewImage)
    {
       if($_FILES[$NewImage]['error']==4)
        {
			return $OldImage;  
        }
        else
        {
            if($OldImage != "")
            {
                unlink(FCPATH.$Path.$OldImage); 
            }   
            if ( ! file_exists(FCPATH.$Path))
            {
                $create = mkdir(FCPATH.$Path,0777,TRUE);
                if ( ! $create)
                return;
            }
            $NewFileName=  $this->RenameImage($_FILES[$NewImage]['name']);
            if(move_uploaded_file(realpath($_FILES[$NewImage]['tmp_name']),FCPATH.$Path.$NewFileName))
            {
                return $NewFileName;
            }
            else
            {
                return '';
            }
        }
        
    }
    
    //================ DELETE IMAGE FROM FOLDER =============
    
    /* 
       PARAMETER REQUIRED:
     * PARAM 1:FOLDER PATH
     * PARAM 2:IMAGE NAME NAME
    */
    public function DeleteImage($path)
    {
       
        $data=explode("/", $path);
       $temp=$data[4].'/'.$data[5].'/'.$data[6];
       //print_r($data);
     
        if($temp!='')
        unlink($temp); 
    }
	
	
	//================ DELETE IMAGE FROM FOLDER for Client Side =============
    
    /* 
       PARAMETER REQUIRED:
     * PARAM 1:FOLDER PATH
     * PARAM 2:IMAGE NAME NAME
    */
    public function DeleteImage_client($Path,$OldImage)
    {
		unlink(FCPATH.$Path.$OldImage);   
    }

    //================ IMAGE RANAME WITH UNIQUE NAME =============
    
    /* 
       PARAMETER REQUIRED:
     * PARAM 1:IMAGE NAME
    */
    public function RenameImage($imageName)
    {
        $randString = md5(time().$imageName);
        $fileName =$imageName;
        $splitName = explode(".", $fileName);
        $fileExt = end($splitName); 
        return strtolower($randString.'.'.$fileExt);
    }
}