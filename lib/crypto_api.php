<?php
require __DIR__ . '/../vendor/autoload.php';
use phpFastCache\CacheManager;
/**
 * You don't use composer ?
 * Fine! PhpFastCache provides
 * his own autoloader.
 */#
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
    echo $CachedString->get();
} else {
    $res = $CachedString->get();
    echo $res;
}
?>