<?php

$id = $_GET['id'] ?? "1";


$idtofsASSETID = [
    '1' => '4gtv-4gtv003',
    '2' => '4gtv-4gtv001',
    '3' => '4gtv-4gtv002',
    '4' => '4gtv-4gtv040',
    '6' => '4gtv-4gtv041',
    '7' => '4gtv-4gtv042',
    '8' => 'litv-ftv17',
    '9' => 'litv-ftv16',
    '11' => '4gtv-4gtv018',
    '15' => '4gtv-4gtv044',
    '16' => '4gtv-4gtv004',
    '19' => '4gtv-4gtv070',
    '21' => '4gtv-4gtv046',
    '22' => '4gtv-4gtv047',
    '23' => 'litv-longturn18',
    '24' => 'litv-ftv09',
    '25' => '4gtv-4gtv049',
    '28' => 'litv-longturn11',
    '30' => '4gtv-4gtv009',
    '31' => 'litv-ftv13',
    '33' => '4gtv-4gtv074',
    '34' => '4gtv-4gtv052',
    '36' => 'litv-longturn14',
    '38' => '4gtv-4gtv013',
    '39' => '4gtv-4gtv017',
    '40' => '4gtv-4gtv011',
    '42' => '4gtv-4gtv055',
    '48' => 'litv-longturn05',
    '50' => 'litv-longturn07',
    '51' => 'litv-longturn10',
    '52' => 'litv-longturn09',
    '57' => '4gtv-4gtv077',
    '58' => '4gtv-4gtv101',
    '59' => '4gtv-4gtv057',
    '60' => 'litv-ftv15',
    '61' => 'litv-ftv07',
    '69' => '4gtv-4gtv014',
    '78' => '4gtv-4gtv082',
    '79' => '4gtv-4gtv083',
    '80' => '4gtv-4gtv059',
    '82' => '4gtv-4gtv061',
    '83' => '4gtv-4gtv062',
    '84' => '4gtv-4gtv063',
    '85' => 'litv-ftv10',
    '86' => 'litv-ftv03',
    '88' => '4gtv-4gtv065',
    '93' => '4gtv-4gtv035',
    '94' => '4gtv-4gtv038',
    '106' => 'litv-longturn20',
    '107' => '4gtv-4gtv043',
    '113' => '4gtv-4gtv006',
    '114' => '4gtv-4gtv039',
    '116' => '4gtv-4gtv058',
    '118' => '4gtv-4gtv045',
    '119' => '4gtv-4gtv054',
    '121' => 'litv-longturn03',
    '123' => '4gtv-4gtv064',
    '124' => '4gtv-4gtv080',
    '139' => '4gtv-live208',
    '160' => '4gtv-live201',
    '168' => '4gtv-live206',
    '169' => '4gtv-live207',
    '170' => '4gtv-4gtv084',
    '171' => '4gtv-4gtv085',
    '172' => '4gtv-4gtv034',
    '173' => '4gtv-live047',
    '174' => '4gtv-live046',
    '175' => '4gtv-live121',
    '176' => '4gtv-live157',
    '178' => '4gtv-live122',
    '179' => '4gtv-4gtv053',
    '180' => '4gtv-live138',
    '181' => '4gtv-live109',
    '182' => '4gtv-live110',
    '183' => '4gtv-4gtv073',
    '184' => '4gtv-4gtv068',
    '185' => '4gtv-live105',
    '186' => '4gtv-live620',
    '188' => '4gtv-live030',
    '189' => '4gtv-4gtv079',
    '201' => '4gtv-live021',
    '202' => '4gtv-live022',
    '204' => '4gtv-live024',
    '209' => '4gtv-live007',
    '210' => '4gtv-live008',
    '212' => '4gtv-live023',
    '213' => '4gtv-live025',
    '214' => '4gtv-live026',
    '215' => '4gtv-live027',
    '217' => '4gtv-live029',
    '218' => '4gtv-live031',
    '219' => '4gtv-live032',
    '223' => '4gtv-live050',
    '224' => '4gtv-live060',
    '225' => '4gtv-live069',
    '226' => '4gtv-live071',
    '227' => '4gtv-4gtv067',
    '229' => '4gtv-live089',
    '230' => '4gtv-live106',
    '231' => '4gtv-live107',
    '235' => '4gtv-live130',
    '236' => '4gtv-live144',
    '237' => '4gtv-live120',
    '244' => '4gtv-live006',
    '245' => '4gtv-live005',
    '246' => '4gtv-live215',
    '249' => '4gtv-live012',
    '250' => 'litv-longturn17',
    '252' => '4gtv-live112',
    '254' => '4gtv-live403',
    '255' => '4gtv-live401',
    '256' => '4gtv-live452',
    '257' => '4gtv-live413',
    '258' => '4gtv-live474',
    '260' => '4gtv-live409',
    '261' => '4gtv-live417',
    '262' => '4gtv-live408',
    '264' => '4gtv-live405',
    '265' => '4gtv-live404',
    '266' => '4gtv-live407',
    '267' => '4gtv-live406',
    '268' => '4gtv-4gtv075',
    '269' => '4gtv-live009',
    '270' => '4gtv-live010',
    '273' => '4gtv-live014',
    '274' => '4gtv-live011',
    '275' => '4gtv-live080',
    '276' => '4gtv-live410',
    '277' => '4gtv-live411',
    '278' => '4gtv-live015',
    '279' => '4gtv-live016',
    '280' => 'litv-longturn15',
    '281' => 'litv-longturn23',
    '282' => '4gtv-live017',
    '283' => '4gtv-live059',
    '284' => '4gtv-live087',
    '285' => '4gtv-live088',
    '286' => '4gtv-live049',
    '287' => '4gtv-live048',
    '288' => '4gtv-4gtv016',
    '289' => '4gtv-live301',
    '290' => '4gtv-live302',
    '291' => '4gtv-4gtv072',
    '292' => '4gtv-4gtv152',
    '293' => '4gtv-4gtv153',
];

$fsASSET_ID = $idtofsASSETID[$id];


$authval = generate4GTV_AUTH();

$fsENC_KEY = generateUuid();


$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, 'https://api2.4gtv.tv/App/GetChannelUrl2');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
//curl_setopt($curl, CURLOPT_PROXY, "192.168.10.152:6152"); // 代理 IP 和端口
//curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); // 使用 HTTP 代理
// curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5); // 使用 SOCKS5 代理
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl, CURLOPT_POSTFIELDS, '{"fnCHANNEL_ID":"' . $id . '","fsDEVICE_TYPE":"mobile","clsAPP_IDENTITY_VALIDATE_ARUS":{"fsVALUE":"","fsENC_KEY":"' . $fsENC_KEY . '"},"fsASSET_ID":"' . $fsASSET_ID . '"}');
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "4GTV_AUTH: $authval",
    'fsDEVICE: iOS',
    "fsVALUE: ",
    'fsVERSION: 3.2.1',
    "fsENC_KEY: $fsENC_KEY",
    'User-Agent: %E5%9B%9B%E5%AD%A3%E7%B7%9A%E4%B8%8A/1 CFNetwork/1568.200.51 Darwin/24.1.0',
    'Content-Type: application/json',
    'Accept: */*',
    'Host: api2.4gtv.tv',
    'Connection: keep-alive'
));
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

$response = curl_exec($curl);

curl_close($curl);

$data = json_decode($response, true);

$urls = $data['Data']['flstURLs'];
$filteredUrls = [];

$finalUrl = "";
foreach ($urls as $url) {
    if (strpos($url, 'cds.cdn.hinet.net') === false) {
        $finalUrl = $url;
    }
}

if (strpos($finalUrl, 'https://4gtvfree-mozai.4gtv.tv') === 0) {
    $finalUrl = str_replace('/index.m3u8?', '/1080.m3u8?', $finalUrl);
    header('location:' . $finalUrl);
    exit();
} else {
    $finalUrl = get_playURL($finalUrl, 'url');
    $m3u8Content = get_playURL($finalUrl, "ts");


    $preArray = explode('/', explode('?', $finalUrl)[0]);

    $midArray = explode('-', $preArray[count($preArray) - 1]);

    $channel = $midArray[0] . '-' . $midArray[1];

    $lines = [];

    $prex = "https://litvpc-hichannel.cdn.hinet.net/live/pool/{$channel}/litv-pc/";

    foreach (explode("\n", $m3u8Content) as $line) {
        if (strpos($line, '#EXT') === 0 || trim($line) === '') {
            $lines[] = $line;
        } else {
            $ts_file_array = explode('/', explode('?', $line)[0]);
            $ts_file = $ts_file_array[count($ts_file_array) - 1];
            $ts_file = str_replace('video=2000000', 'video=6000000', $ts_file);
            $ts_file = str_replace('video=2936000', 'video=5936000', $ts_file);
            $ts_file = str_replace('video=3000000', 'video=6000000', $ts_file);
            $ts_file = str_replace('avc1_2000000=3', 'avc1_6000000=1', $ts_file);
            $ts_file = str_replace('avc1_2000000=6', 'avc1_6000000=1', $ts_file);
            $ts_file = str_replace('avc1_2936000=4', 'avc1_6000000=5', $ts_file);
            $ts_file = str_replace('avc1_3000000=3', 'avc1_6000000=1', $ts_file);
            $ts_url = $prex . $ts_file;
            $lines[] = $ts_url;
        }
    }

    $m3u8Content = implode("\n", $lines);
    header("Content-Type: application/vnd.apple.mpegurl");
    echo $m3u8Content;
}

function generateUuid()
{
    $data = random_bytes(16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    $uuid = sprintf(
        '%08s-%04s-%04s-%04s-%12s',
        bin2hex(substr($data, 0, 4)),
        bin2hex(substr($data, 4, 2)),
        bin2hex(substr($data, 6, 2)),
        bin2hex(substr($data, 8, 2)),
        bin2hex(substr($data, 10, 6))
    );

    return strtoupper($uuid);
}

function generate4GTV_AUTH()
{
    $headKey = "PyPJU25iI2IQCMWq7kblwh9sGCypqsxMp4sKjJo95SK43h08ff+j1nbWliTySSB+N67BnXrYv9DfwK+ue5wWkg==";
    $KEY = "ilyB29ZdruuQjC45JhBBR7o2Z8WJ26Vg";
    $IV = "JUMxvVMmszqUTeKn";
    $decode = base64_decode($headKey);
    $format = gmdate("Ymd");
    $decrypted = openssl_decrypt($decode, "aes-256-cbc", $KEY, OPENSSL_RAW_DATA, $IV);
    $toHash = $format . $decrypted;
    $sha512Binary = hash('sha512', $toHash, true);
    $finalResult = base64_encode($sha512Binary);
    return $finalResult;
}

function get_playURL($url, $return_type)
{
    $headers = [
        'User-Agent: okhttp/3.12.11'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    if (!$response) {
        return null;
    }

    $parsed_url = parse_url($url);
    $resp_text = trim($response);
    $lines = explode("\n", $resp_text);
    $latest_line = end($lines);
    $url_path = dirname($parsed_url['path']);
    $new_url = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $url_path . '/' . $latest_line;


    if ($return_type === 'url') {
        return $new_url;
    }

    if (strpos($latest_line, '.ts') !== false) {
        return $resp_text;
    } else {
        return get_playURL($new_url, $return_type);
    }
}
