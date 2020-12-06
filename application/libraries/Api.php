<?php
     class Api{
          
          protected $CI;

          function __construct(){
               $this->CI =& get_instance();
          }

          function get($url){
               // inisiasi curl
               $ch = curl_init();
               // akan mengembalikan nilai respon, jika salah maka respon akan di cetak
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               // set url
               curl_setopt($ch, CURLOPT_URL, $url);
               // eksekusi
               $data = curl_exec($ch);
               curl_close($ch);
               return $data;
          }
     }
?>