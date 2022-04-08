<?php 
include("config.php");

$get = file_get_contents('http://localhost:8500/home/the.xml');
$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $get);
$xml = new SimpleXMLElement($response);
$array = json_decode(json_encode((array)$xml), TRUE); 
$data = $array;
//$data = json_decode($data,true);
$reAmount = 0;
//foreach($data as $item => $type)
//{
//   $reAmount = $reAmount + $type['Amount'];
//}
//echo $reAmount;
function Encrypt($input, $key_seed){
    $input = trim($input);
    $block = mcrypt_get_block_size('tripledes', 'ecb');
    $len = strlen($input);
    $padding = $block - ($len % $block);
    $input .= str_repeat(chr($padding),$padding);
    // generate a 24 byte key from the md5 of the seed
    $key = substr(md5($key_seed),0,24);
    $iv_size = mcrypt_get_iv_size(MCRYPT_TRIPLEDES,
   MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    // encrypt
    $encrypted_data = mcrypt_encrypt(MCRYPT_TRIPLEDES, $key,
   $input,
   MCRYPT_MODE_ECB, $iv);
    // clean up output and return base64 encoded
    return base64_encode($encrypted_data);
   } //end function Encrypt()

function Decrypt($input, $key_seed)
{
   $input = base64_decode($input);
   $key = substr(md5($key_seed),0,24);
   $text=mcrypt_decrypt(MCRYPT_TRIPLEDES, $key, $input,
   MCRYPT_MODE_ECB,'12345678');
   $block = mcrypt_get_block_size('tripledes', 'ecb');
   $packing = ord($text{strlen($text) - 1});
   if($packing and ($packing < $block)){
   for($P = strlen($text) - 1; $P >= strlen($text) - $packing; $P--){
   if(ord($text{$P}) != $packing){
   $packing = 0; 
      }
      }
   }
   $text = substr($text,0,strlen($text) - $packing);
   return $text;
}
print_r($data);
?>