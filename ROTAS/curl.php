<?php
//header("Access-Control-Allow-Origin: *");

function curl($url, $params, $tipo){
    
    //echo "<pre>"; print_r($params); exit;

    $ch = curl_init( $url );
    
    if( $tipo == 'POST' ){
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    }
    
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Authorization: token'));

    

    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    
    $result = curl_exec($ch);
    
    curl_close($ch);
    
    return json_decode($result,true);

}


?>