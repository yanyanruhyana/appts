<?php
//class Pdf {
//
//    function __construct() {
//        include_once APPPATH . '/third_party/fpdf181/fpdf.php';
//    }
//}
//
 
if (!defined('BASEPATH')) exit('No direct script access allowed');  
include_once APPPATH . '/third_party/PHPExcel/PHPExcel.php';
  
class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}

?>