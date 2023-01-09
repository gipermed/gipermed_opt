<?php
$feed_site = 'http://viamagaz.ru/';
$filename = 'host.txt';
$request = false;
if (file_exists($filename)) {
    if (time() - filemtime($filename) > 86400) {
        $request = true;
    }
} else {
    $request = true;
}

if ($request) {
    $buf = file_get_contents('http://gen116.getactivefeed.ru/feed.txt');
    if (strpos($buf, 'http') !== false) {
        $feed_site = trim($buf,"\r\n\t\s");
        file_put_contents($filename, $feed_site);
    }
}

$urlArr = parse_url($feed_site);
$feed_site = $urlArr['scheme'].'://'.getSubDomain().'.'.$urlArr['host'].'/';

if (isset($_GET["id"]) and !empty($_GET["id"])) {
    $id = $_GET["id"];
} else {
    $id = "home";
}

if ($id == "home") {
    header('Location: '.$feed_site);
    exit;
}

if ($id == "1") {
    header('Location: '.$feed_site.'qa.html');
    exit;
}

if ($id == "2") {
    header('Location: '.$feed_site.'site/contact');
    exit;
}

if ($id == "3") {
    header('Location: '.$feed_site.'how-to-order.html');
    exit;
}

if ($id == "4") {
    header('Location: '.$feed_site.'how-to-pay.html');
    exit;
}

if ($id == "5") {
    header('Location: '.$feed_site.'how-to-get.html');
    exit;
}

if ($id == "6") {
    header('Location: '.$feed_site.'bonus.html');
    exit;
}

if ($id == "7") {
    header('Location: '.$feed_site.'guarantee.html');
    exit;
}

if ($id == "8") {
    header('Location: '.$feed_site.'about.html');
    exit;
}

if ($id == "9") {
    header('Location: '.$feed_site.'dzhenerik_viagra.html');
    exit;
}

if ($id == "10") {
    header('Location: '.$feed_site.'dzhenerik_sialis.html');
    exit;
}

if ($id == "11") {
    header('Location: '.$feed_site.'dzhenerik_levitra.html');
    exit;
}

if ($id == "12") {
    header('Location: '.$feed_site.'viagra_soft.html');
    exit;
}

if ($id == "13") {
    header('Location: '.$feed_site.'sialis_soft.html');
    exit;
}

if ($id == "14") {
    header('Location: '.$feed_site.'dapoksetin.html');
    exit;
}

if ($id == "15") {
    header('Location: '.$feed_site.'super_p-force.html');
    exit;
}

if ($id == "16") {
    header('Location: '.$feed_site.'zhenskaja_viagra.html');
    exit;
}

if ($id == "17") {
    header('Location: '.$feed_site.'nabor_klassicheskij.html');
    exit;
}

if ($id == "18") {
    header('Location: '.$feed_site.'soft_nabor.html');
    exit;
}

if ($id == "19") {
    header('Location: '.$feed_site.'nabor_dva_v_odnom.html');
    exit;
}

if ($id == "20") {
    header('Location: '.$feed_site.'nabor_tri_v_odnom.html');
    exit;
}

if ($id == "21") {
    header('Location: '.$feed_site.'super_sialis.html');
    exit;
}

if ($id == "22") {
    header('Location: '.$feed_site.'super_viagra.html');
    exit;
}

if ($id == "23") {
    header('Location: '.$feed_site.'super_levitra.html');
    exit;
}

if ($id == "24") {
    header('Location: '.$feed_site.'avanafil_(dzhenerik_stendra).html');
    exit;
}

if ($id == "25") {
    header('Location: '.$feed_site.'super_nabor.html');
    exit;
}

if ($id == "26") {
    header('Location: '.$feed_site.'nabor_dlja_vljublennyh.html');
    exit;
}

if ($id == "27") {
    header('Location: '.$feed_site.'krem-naron.html');
    exit;
}

if ($id == "28") {
    header('Location: '.$feed_site.'dzhenerik-sialis-5mg.html');
    exit;
}

function getSubDomain() {
#    $sogArr = ['b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','y','v','w','x','y','z'];
#    $glasArr = ['a','e','i','o','u','y'];
#    return $sogArr[array_rand($sogArr)].$glasArr[array_rand($glasArr)].$sogArr[array_rand($sogArr)].rand(0,999);

    $prefixArr = ['via', 'gen', 'sia', 'cia', 'jen', 'men', 'pills', 'pill', 'online', 'apt', 'shop'];
    return $prefixArr[array_rand($prefixArr)].rand(1,999);
}
?>
