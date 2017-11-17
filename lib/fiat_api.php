<?php
use phpFastCache\CacheManager;
/**
 * You don't use composer ?
 * Fine! PhpFastCache provides
 * his own autoloader.
 */#
require __DIR__ . '/cache/src/autoload.php';

$InstanceCache = CacheManager::getInstance('files');

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
	echo $CachedString->get();
} else {
    echo $CachedString->get();
}
?>