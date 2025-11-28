<?php

error_reporting(0);
date_default_timezone_set('Asia/Jakarta');

const hitam  = "\033[0;30m";
const merah  = "\033[0;31m";
const hijau  = "\033[0;32m";
const kuning = "\033[0;33m";
const biru   = "\033[0;34m";
const cyan   = "\033[0;36m";
const putih  = "\033[0;37m";

const faucet = "https://freeltc.fun/faucet/currency/ltc";
const urlicon = "https://freeltc.fun/icaptcha/req";

function clear() {(PHP_OS == "Linux") ? system('clear') : pclose(popen('cls','w'));}

function timer($_0x133, $_0x134="[!] please wait") {
    $_0x135 = (int)$_0x133;
    $_0x136 = ['⣾','⣽','⣻','⢿','⡿','⣟','⣯','⣷'];
    $_0x137 = count($_0x136);
    $_0x138 = 0;
    $_0x139 = 0.1;
    $_0x13A = 1/$_0x139;
    while ($_0x135 > 0) {
        $_0x13B = microtime(true);
        $_0x13C = 0;
        while ((microtime(true) - $_0x13B) < 1) {
            $_0x13D = floor($_0x135 / 60);
            $_0x13E = $_0x135 % 60;
            $_0x13F = sprintf('%02d:%02d:%02d', 0, $_0x13D, $_0x13E);
            $_0x140 = $_0x136[$_0x138];
            echo putih . $_0x134 . hijau . " $_0x13F " . putih . $_0x140 . "\r";
            usleep($_0x139 * 1000000);
            $_0x138 = ($_0x138 + 1) % $_0x137;
            $_0x13C++;
            if ((microtime(true) - $_0x13B) >= 1) break;
        }
        $_0x135--;
    }
    echo "\r                                     \r";
}

function skibidixxx($_0x141, $_0x142 = 'GET', $_0x143 = [], $_0x144 = []) {
    while (true) {
        $_0x145 = curl_init();
        $_0x146 = [];
        foreach ($_0x144 as $_0x147) {
            $_0x146[] = str_replace('$coki', $_0x148, $_0x147);
        }
        $_0x149 = [
            CURLOPT_URL => $_0x141,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYHOST => 1,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_HTTPHEADER => $_0x146,
            CURLOPT_CONNECTTIMEOUT => 999,
            CURLOPT_TIMEOUT => 999
        ];
        if (strtoupper($_0x142) === 'POST') {
            $_0x149[CURLOPT_POST] = true;
            $_0x149[CURLOPT_POSTFIELDS] = $_0x143;
        }
        curl_setopt_array($_0x145, $_0x149);
        $_0x14A = curl_exec($_0x145);
        if ($_0x14A) {
            $_0x14B = curl_getinfo($_0x145, CURLINFO_HEADER_SIZE);
            $_0x14C = substr($_0x14A, $_0x14B);
            curl_close($_0x145);
            return $_0x14C;
        } else {
            $_0x14D = curl_error($_0x145);
            curl_close($_0x145);
            echo "\33[1;" . rand(30,37) . "mwiwok detok";
            sleep(1);
            echo "\r \r";
            continue;
        }
    }
}

function IconCaptcha($host, $iconToken, $cookie, $urlIcon) {
    $url = "https://waryono.my.id/api/iconcaptcha";
    $data = json_encode([
        'host' => $host,
        'icon_token' => $iconToken,
        'cookie' => $cookie,
        'url_icon' => $urlIcon
    ]);
    $headers = ['Content-Type: application/json'];
    $eksekusi = skibidixxx($url, "POST", $data, $headers);
    if (strpos($eksekusi, "success") !== false) {
    	$json = json_decode($eksekusi, true);
    	return [
    		"ic-wid" => $json["ic-wid"],
    		"ic-cid" => $json["ic-cid"]
    	];

    	} elseif (strpos($eksekusi, "CAPTCHA_UNSOLVEABLE") !== false) {
    		echo putih."Error: CAPTCHA_UNSOLVEABLE\n";
    		echo putih."reason: LOAD_REQUEST_FAILED\n";
    		exit;
    		
    	} elseif (strpos($eksekusi, "CAPTCHA_UNSOLVEABLE") !== false) {
    		echo putih."Error: CAPTCHA_UNSOLVEABLE\n";
    		echo putih."reason: invalid_base64\n";
    		exit;

    	} elseif (strpos($eksekusi, "CAPTCHA_UNSOLVEABLE") !== false) {
    		echo putih."Error: CAPTCHA_UNSOLVEABLE\n";
    		echo putih."reason: identifier_missing\n";
    		exit;

    	} elseif (strpos($eksekusi, "Internal Server Error") !== false ) {
    		echo putih."[ERROR] Internal Server Error!\n";
    		exit;

    	} else {
    		echo putih."UNKNOWN ERROR!\n";
    		echo putih."DEBUG: ".$eksekusi."\n";
    		exit;
    	}
    
}

function cekpeler($a) {
	$cekkintil = skibidixxx(faucet, "GET", [], $a);
	$bl = explode('</p>', explode('<p class="usd">', $cekkintil)[1])[0];

	if (!empty($bl)) {
		return ["bl" => $bl];

	} else {
		echo putih."GANTI COOKIHH NYA!\n";
		exit;
	}
}

	// this -> config
	$cookie = "csrf_cookie_name=60cb0186a317c73e86f7947370554cd8; ci_session=fa0065bd22fb24a4b354ad6d4ef3bfcd9c9328af; cf_clearance=i8EUyMWqeA9Q_xt1U4aKMq2sxpHIIRWElqXuhkMy35o-1764300377-1.2.1.1-xZmCnuVS4MbrOLMDZ9xXu9hdT3c0j0ZNX9lH0JvpremtlOmivOAV4C7RZUbpGjfCNWFyoOOvYPd09EYQMDAYTbwM6F0sSNTAlbqNbU9JSBq7ezKjC.v6RqnrxnFD1zlZXJigaJ8Q.otnxLgAC3HEBI8o.zf1g7hm6jH_pRzGqDJahXKZoXQIEJDW_EdOFNzl80c0VM59knUjyNW0q9I1dHgWJ9eibItAR6uN.BVuYzE";
	$user_agent = "Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36";

	$host = "freeltc.fun";
	$urlicon = "https://freeltc.fun/icaptcha/req";
	
	// this -> headers Dashboard / Faucet
	$a = [
		"host: freeltc.fun",
		"user-agent: ".$user_agent,
		"accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,q=0.8,application/signed-exchange;v=b3;q=0.7",
		"referer: https://freeltc.fun/",
		"accept-language: id,en-US;q=0.9,en;q=0.8,ms;q=0.7,ru;q=0.6",
		"cookie: ".$cookie
	];

	// this -> headers claim
	$b = [
		"host: freeltc.fun",
		"origin: https://freeltc.fun",
		"content-type: application/x-www-form-urlencoded",
		"user-agent: ".$user_agent,
		"accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,q=0.8,application/signed-exchange;v=b3;q=0.7",
		"referer: https://freeltc.fun/",
		"accept-language: id,en-US;q=0.9,en;q=0.8,ms;q=0.7,ru;q=0.6",
		"cookie: ".$cookie
	];

clear();
$y = cekpeler($a);
$bl = $y["bl"];

echo cyan."Sckirpt Freeltc pun 🤓\n";
echo putih."Open saurke\n";
echo putih."Balance ".cyan.$bl."\n\n";

while(true) {
		$faucet = skibidixxx(faucet, "GET", [], $a);
		    preg_match('/name="csrf_token_name"[^>]*value="([^"]*)"/', $faucet, $_X901);
			$csrf = $_X901[1];
			preg_match('/name="token"[^>]*value="([^"]*)"/', $faucet, $_0XIi1);
			$token = $_0XIi1[1];
			preg_match('/name="wallet"[^>]*value="([^"]*)"/', $faucet, $_0x77b);
			$wallet = $_0x77b[1];
			preg_match("/name='_iconcaptcha-token'[^>]*value='([^']*)'/", $faucet, $_0kKlj);
			$icon_token = $_0kKlj[1];
			preg_match('/<form id="fauform"[^>]*action="([^"]*)"/', $faucet, $_0Xj7zb);
			$url_verify = $_0Xj7zb[1];

			$solver = IconCaptcha($host, $icon_token, $cookie, $urlicon);
			$icwid = $solver["ic-wid"];
			$iccid = $solver["ic-cid"];

		$data = http_build_query([
			  "csrf_token_name" => $csrf,
			  "token" => $token,
			  "captcha" => "icaptcha",
			  "_iconcaptcha-token" => $icon_token,
			  "ic-rq" => "1",
			  "ic-wid" => $icwid,
			  "ic-cid" => $iccid,
			  "ic-hp" => "",
			  "wallet" => $wallet
		]);
		$claim = skibidixxx($url_verify, "POST", $data, $b);
		if (strpos($claim, "success") !== false) {
			$bokep_mantap = explode("'", explode("html: '", $claim)[1])[0];
			$crot_dimuka = strip_tags($bokep_mantap);
			$waktu = explode(" -", explode("var wait = ", $claim)[1])[0];
			echo hijau.$crot_dimuka."\n";
			timer($waktu);

		} elseif (strpos($claim, "failed") !== false) {
			$bokep_mantap = explode("'", explode("html: '", $claim)[1])[0];
			$crot_dimuka = strip_tags($bokep_mantap);
			echo kuning.$crot_dimuka."\n";

		} else {
			echo "Eror nya cari sendiri!\n";
			exit;
		}

				
}
