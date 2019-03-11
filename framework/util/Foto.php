<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Foto
 *
 * @author Administrator
 */
namespace framework\util;

class Foto {
    public static function isAfbeeldingGestuurd() 
    {
        
        if(empty($_FILES['foto']['tmp_name'])||empty($_FILES['foto']['type']))
        {
            return IMAGE_FAILURE_NO_IMAGE_UPLOADED;
        }
        
        if(empty($_FILES['foto']['size'])||empty($_FILES['foto']['tmp_name']))
        {   
            return IMAGE_FAILURE_SIZE_EXCEEDED;
        }
        
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $ext = $finfo->file($_FILES['foto']['tmp_name']);
        $allowed = array(
            'image/jpeg',
            'image/png',
            'image/gif',
        );
        if( ! in_array( $ext, $allowed ) ){
            //return self::WRONG_IMAGE_TYPE;
            return IMAGE_FAILURE_WRONG_TYPE;
        }
       
        return IMAGE_SUCCES;        
    }
    
    public static function bepaalBestandsNaam()
    {
        $foto_tmp_name = $_FILES['foto']['tmp_name'];
        $foto_name = $_FILES['foto']['name'];
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($_FILES['foto']['tmp_name']);
        $allowed = array(
            'jpg'=>'image/jpeg',
            'png'=>'image/png',
            'gif'=>'image/gif',
        );
        $ext = array_search($mime,$allowed,true);
        if($ext===false){
            return false;
        }
        
        $tehashenNaam = $foto_name.".$ext";
        $teller =0;
        $nieuweFotoNaam = md5($tehashenNaam).".$ext";
        while(file_exists(IMAGE_LOCATION.$nieuweFotoNaam)){
            $tehashenNaam = $teller.$tehashenNaam;
            $nieuweFotoNaam = md5($tehashenNaam).".$ext";
            $teller++;
        }
        return $nieuweFotoNaam;
    }
    
    public static function slaAfbeeldingOp($fotoNaam)
    {
         $foto_tmp_name = $_FILES['foto']['tmp_name'];
         return \move_uploaded_file($foto_tmp_name, IMAGE_LOCATION.$fotoNaam);
    }
    
    public static function removeOudeAfbeelding($naam)
    {
        if($naam!==IMAGE_DEFAULT_NAME &&  \file_exists(IMAGE_LOCATION.$naam)){
            unlink(IMAGE_LOCATION.$naam);
        }
    }
}
