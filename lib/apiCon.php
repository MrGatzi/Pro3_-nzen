<?php
use phpFastCache\CacheManager;
require __DIR__ . '/cache/src/autoload.php';
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 17.11.2017
 * Time: 23:19
 */
function getCrypto()
{

    $InstanceCache = CacheManager::getInstance('files');
    $key = "crypto";
    //$InstanceCache->clear(); clears cache
    $CachedString = $InstanceCache->getItem($key);
    if (is_null($CachedString->get())) {
        $url = "https://api.coinmarketcap.com/v1/ticker/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);
        $res = [];
        foreach ($result as &$row) {

            array_push($res, array("symbol" => $row['symbol'], 'value' => $row['price_usd']));
        }
        $CachedString->set(json_encode($res))->expiresAfter(100);
        $InstanceCache->save($CachedString);
        return $CachedString->get();
    } else {
        $res = $CachedString->get();
        return $res;


    }
}
    function getUSD(){


        $InstanceCache = CacheManager::getInstance('files');
        //$InstanceCache->clear(); //clears cache
        $key = "fiat";
        $CachedString = $InstanceCache->getItem($key);
        if (is_null($CachedString->get())) {
            $url = "https://api.fixer.io/latest?base=USD";
            $ch  = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch);
            curl_close($ch);

            $CachedString->set($result)->expiresAfter(500);
            $InstanceCache->save($CachedString);
            //echo $CachedString->get();
            return 'AAA';
            echo '1';
        } else {
            //echo $CachedString->get();
            echo '3';
            return 'BBB';
        }
    }