<?php
require __DIR__ . '/../vendor/autoload.php';
use phpFastCache\CacheManager;
/**
 * You don't use composer ?
 * Fine! PhpFastCache provides
 * his own autoloader.
 */#

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
    $result = json_decode(curl_exec($ch), true);
    curl_close($ch);

    $res = [];
    $res[$result["base"]] = 1;

    foreach ($result["rates"] as $key => $value) {
        $res[$key]=$value;
    }
    $CachedString->set(json_encode($res))->expiresAfter(500);
    $InstanceCache->save($CachedString);
    echo $CachedString->get();
} else {
    echo $CachedString->get();
}
?>