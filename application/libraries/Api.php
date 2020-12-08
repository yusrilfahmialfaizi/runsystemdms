<?php
class Api
{

     protected $CI;

     function __construct()
     {
          $this->CI = &get_instance();
     }

     function get($url)
     {
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

     function delete($url)
     {
          // inisiasi curl
          $ch = curl_init();
          // set url
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
          $data = curl_exec($ch);
          $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
          curl_close($ch);
          return $data;
     }
}
