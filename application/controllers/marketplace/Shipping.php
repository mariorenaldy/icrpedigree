<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[\AllowDynamicProperties]

class Shipping extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function getProvince(){
        $site_lang = $this->input->cookie('site_lang');
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FAILONERROR => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: ab19f705c743f17f6d2b8d3f318638dc"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "Error cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response, TRUE);
            switch ($array_response["rajaongkir"]["status"]["code"]) {
                case 200:  # OK
                    $provinceData = $array_response["rajaongkir"]["results"];
                
                    if ($site_lang == 'indonesia') {
                        echo "<option value=''>--Pilih Provinsi--</option>";
                    }
                    else{
                        echo "<option value=''>--Select Province--</option>";
                    }
        
                    foreach($provinceData as $key => $province){
                        echo "<option value='".$province["province_id"]."'>";
                        echo $province["province"];
                        echo "</option>";
                    }
                    break;
                default:
                    echo "Error ".$array_response["rajaongkir"]["status"]["description"];
            }
        }
    }
	public function getCity(){
        $site_lang = $this->input->cookie('site_lang');
        $provinceID = $_POST["provinceID"];
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$provinceID,
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_FAILONERROR => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: ab19f705c743f17f6d2b8d3f318638dc"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "Error cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response, TRUE);
            switch ($array_response["rajaongkir"]["status"]["code"]) {
                case 200:  # OK
                    $cityData = $array_response["rajaongkir"]["results"];
                
                    if ($site_lang == 'indonesia') {
                        echo "<option value=''>--Pilih Kota/Kabupaten--</option>";
                    }
                    else{
                        echo "<option value=''>--Select City/Regency--</option>";
                    }
        
                    foreach($cityData as $key => $city){
                        echo "<option value='".$city["city_id"]."'>";
                        echo $city["type"]." ";
                        echo $city["city_name"];
                        echo "</option>";
                    }
                    break;
                default:
                    echo "Error ".$array_response["rajaongkir"]["status"]["description"];
            }
        }
    }
	public function getCost(){
        $site_lang = $this->input->cookie('site_lang');
        $cityID = $_POST["cityID"];
        $weight = $_POST["weight"];
        $shipping = $_POST["shipping"];
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_FAILONERROR => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=23&destination=".$cityID."&weight=".$weight."&courier=".$shipping,
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: ab19f705c743f17f6d2b8d3f318638dc"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "Error cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response, TRUE);
            switch ($array_response["rajaongkir"]["status"]["code"]) {
                case 200:  # OK
                    $costData = $array_response["rajaongkir"]["results"]["0"]["costs"];
            
                    if ($site_lang == 'indonesia') {
                        echo "<option value=''>--Pilih Tipe Pengiriman--</option>";
                        foreach($costData as $key => $cost){
                            echo "<option value='".$cost["service"]."' cost='".$cost["cost"]["0"]["value"]."' etd='".$cost["cost"]["0"]["etd"]."'>";
                            echo $cost["service"].' (Estimasi tiba '.str_ireplace(' hari', '', $cost["cost"]["0"]["etd"]).' hari)';
                            echo "</option>";
                        }
                    }
                    else{
                        echo "<option value=''>--Select Shipping Type--</option>";
                        foreach($costData as $key => $cost){
                            echo "<option value='".$cost["service"]."' cost='".$cost["cost"]["0"]["value"]."' etd='".$cost["cost"]["0"]["etd"]."'>";
                            echo $cost["service"].' (Estimated arrival in '.str_ireplace(' hari', '', $cost["cost"]["0"]["etd"]).' days)';
                            echo "</option>";
                        }
                    }
                    break;
                default:
                    echo "Error ".$array_response["rajaongkir"]["status"]["description"];
            }
        }
    }
}
?>