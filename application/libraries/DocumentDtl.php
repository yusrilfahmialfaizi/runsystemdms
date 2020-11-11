<?php
     class DocumentDtl{
          
          protected $CI;

          function __construct(){
               $this->CI =& get_instance();
          }

          function getDocumentDtl($docno,$menucode){
               $data = [
                    "docno" => $docno,
                    "menucode" => $menucode
               ];
               $url = 'http://127.0.0.1:8080/runsystemdms/getDocsDtl';
               $ch = curl_init();

               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($ch, CURLOPT_POST, 1);
               curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
               curl_setopt($ch, CURLOPT_URL, $url);
               $data = curl_exec($ch);
               curl_close($ch);
               return $data;
          }
          function callApiDocDtl($method,$url,$data){
               $ch = curl_init();
               $url = $url;
               switch ($method) {
                    case 'POST':
                         # code...
                         curl_setopt($ch, CURLOPT_POST, 1);
                         if ($data != null) {
                              # code...
                              curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                         }
                         break;

                    case 'PUT':
                         # code...
                         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                         if ($data != null){
                              curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                         }
                         break;
                    
                    default:
                         # code...
                         if ($data)
                              $url = sprintf("%s?%s", $url, http_build_query($data));
                         break;
               }
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($ch, CURLOPT_VERBOSE, true);
               curl_setopt($ch, CURLOPT_URL, $url);
               curl_exec($ch);
               curl_close($ch);

          }
     }
?>