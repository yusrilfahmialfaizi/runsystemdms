<?php
     class Menu {
          protected $CI;

          // We'll use a constructor, as you can't directly call a function
          // from a property definition.
          public function __construct()
          {
               // Assign the CodeIgniter super-object
               $this->CI =& get_instance();
          }

          function getModulMenu(){
               $url = "http://127.0.0.1:8080/runsystemdms/getModuls";
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