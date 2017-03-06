<?php

  abstract class Site{
    public abstract function login();
  }

  class Kijiji extends Site{
    var $login_page = "https://www.kijiji.it/miei-annunci/accedi/";
    var $mail = "spam@pintea.net";
    var $pass = "Lollo123";

    public function login(){
      $ch = curl_init($this->login_page);

      $header=array(
        'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12',
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language: en-us,en;q=0.5',
        'Accept-Encoding: gzip,deflate',
        'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
        'Keep-Alive: 115',
        'Connection: keep-alive',
      );

      baseCurlOPT($ch);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      $res = curl_exec($ch);
      $d = curl_getinfo($ch);
      curl_close($ch);
      return $d;
    }
  }

  $kj = new Kijiji();
  print_r($kj->login());



function baseCurlOPT($curl){
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.1 Safari/537.36");
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
}

?>
