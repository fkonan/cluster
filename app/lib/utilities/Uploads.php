<?php
  namespace App\Lib\Utilities;

  use Core\H;

  class Uploads {

    private $_errors = [], $_files=[], $_maxAllowedSize = 5242880;
    //private $_allowedImageTypes = [IMAGETYPE_GIF,IMAGETYPE_JPEG,IMAGETYPE_PNG];
    private $_allowedImageTypes = ['application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document','image/jpeg'];

    public function __construct($files){
      $this->_files = self::restructureFiles($files);
    }

    public function runValidation(){
      $this->validateSize();
      $this->validateImageType();
    }

    public function validates(){
      return (empty($this->_errors))? true : $this->_errors;
    }

    public function upload($bucket,$name,$tmp){
      if (!file_exists($bucket)) {
          mkdir($bucket);
        }
      $resp = move_uploaded_file($tmp,ROOT.DS.$bucket.$name);
    }

    public function getFiles(){
      return $this->_files;
    }

    /*protected function validateImageType(){
      foreach($this->_files as $file){
        // checking file type
        if(!in_array(exif_imagetype($file['tmp_name']),$this->_allowedImageTypes)){
          $name = $file['name'];
          $msg = $name . " tipo de archivo no soportado. Por favor use jpeg, gif, o png.";
          $this->addErrorMessage($name,$msg);
        }
      }
    }*/

    protected function validateImageType(){
      foreach($this->_files as $file){
        // checking file type
        if(!in_array($file['type'],$this->_allowedImageTypes)){
          $name = $file['name'];
          $msg = "Tipo de archivo no soportado. Por favor use word (doc, docx), o pdf.";
          $this->addErrorMessage($name,$msg);
        }
      }
    }

    protected function validateSize(){
      foreach($this->_files as $file){
        $name = $file['name'];
        if($file['size'] > $this->_maxAllowedSize){
          $msg = $name . " el tamaño maximo del arhicvo es 5mb.";
          $this->addErrorMessage($name,$msg);
        }
      }
    }

    protected function addErrorMessage($name,$message){
      if(array_key_exists($name,$this->_errors)){
        $this->_errors[$name] .= $this->_errors[$name] . " " . $message;
      } else {
        $this->_errors[$name] = $message;
      }
      
    }

    public static function restructureFiles($files){
      $structured = [];
      foreach($files as $key => $val){
        $structured[$key] = [
          'tmp_name'=>$files[$key]['tmp_name'],
          'name'=>$files[$key]['name'],
          'size'=>$files[$key]['size'],
          'error'=>$files[$key]['error'],
          'type'=>$files[$key]['type']
        ];
      }
      return $structured;
    }
  }