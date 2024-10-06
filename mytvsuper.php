<?php
//使用说明：需手动填写token。即可设定定时任务，定期生成缓存文件，也可通过播放器访问http://ip:port/*.php?list=1自动获取列表。
error_reporting(0);
header("Content-Type:application/json;charset=utf-8");
function get_curl($url,$header){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $response = curl_exec($ch);
    return $response;
}
function return_list($purl,$id,$log_ico,$name,$group,$key){
    if($purl===false){
        $m3u=="";
    }else{
        $m3u='#EXTINF:-1 tvg-id="'.$id.' tvg-name="'.$name.'" tvg-logo="https://assets.livednow.com/'.$log_ico.'.png" group-title="'.$group.'",'.$name ."\n"."#KODIPROP:inputstream.adaptive.manifest_type=mpd\n"."#KODIPROP:inputstream.adaptive.license_type=clearkey\n"."#KODIPROP:inputstream.adaptive.license_key=0958b9c657622c465a6205eb2252b8ed:2d2fd7b1661b1e28de38268872b48480\n".$purl."\n";
    }
    return $m3u;
}
function get_purl($header,$id){
    $post = ['platform' => 'android_tv','network_code' => $id,];
    $url = 'https://user-api.mytvsuper.com/v1/channel/checkout?' . http_build_query($post);
    $json=get_curl($url,$header);
    if(json_decode($json,true)["error_message"]==true){
        return false;
    }else{
        $profiles=json_decode($json,true)['profiles'];
        foreach($profiles as $profile) {
           if ($profile['quality'] === 'high') {
              $purl = explode('&p=',$profile['streaming_path'])[0];
              break;
           }
        }
      return $purl;  
    }
}
$cache_list = str_replace(basename(__FILE__),"",__FILE__)."/#mytvsuper.txt";
$list=isset($_GET['list']) ? $_GET['list'] : '';
if($list==""||!file_exists($cache_list)||filesize($cache_list)<=100){
    $n=[
        '1'=>["J","翡翠台 ","logo/翡翠台.png","綜合","0958b9c657622c465a6205eb2252b8ed:2d2fd7b1661b1e28de38268872b48480"],
        '2'=>["JUHD","翡翠台 4K ","logo/翡翠台.png","綜合","2c045f5adb26d391cc41cd01f00416fa:fc146771a9b096fc4cb57ffe769861be"],
        '3'=>["B","TVB Plus ","logo/TVB-Plus.png","綜合","56603b65fa1d7383b6ef0e73b9ae69fa:5d9d8e957d2e45d8189a56fe8665aaaa"],'4'=>["C","無線新聞台 ","logo/無線新聞台.png","新聞財經","90a0bd01d9f6cbb39839cd9b68fc26bc:51546d1f2af0547f0e961995b60a32a1"],
        '5'=>["P","明珠台 ","logo/明珠台.png","新聞財經","e04facdd91354deee318c674993b74c1:8f97a629de680af93a652c3102b65898"],
        '6'=>["CWIN","myTV SUPER FREE ","logo/MytvSuper.png","戲劇電影","0737b75ee8906c00bb7bb8f666da72a0:15f515458cdb5107452f943a111cbe89"],
        '7'=>["C18","myTV SUPER 18台 ","logo/myTV-SUPER-18.png","戲劇電影","72de7d0a1850c8d40c5bdf9747a4ca7c:4967537ff0bc8209277160759de4adef"],
        '8'=>["C28","28 AI 智慧賽馬 ","logo/myTV-28-AI.png","體育","1b778a3241e5fa3bb97d1cb9b57f9e09:3b1f318259fcf0dccd04742cd679fd25"],
        '9'=>["TVG","黃金翡翠台 ","logo/黃金翡翠台.png","戲劇電影","8fe3db1a24969694ae3447f26473eb9f:5cce95833568b9e322f17c61387b306f"],
        '10'=>["CTVC","千禧經典台 ","logo/千禧經典台.png","戲劇電影","6c308490b3198b62a988917253653692:660578b8966fe8012ad51b9aae7a5d78"],
        '11'=>["CDR3","華語劇台 ","logo/華語劇台.png","戲劇電影","baae227b5fc06e2545868d4a1c9ced14:8cd460458b0bdecca5c12791b6409278"],
        '12'=>["CCLM","粵語片台 ","logo/粵語片台.png","戲劇電影","5b90da7fd2f018bf85a757241075626f:75c0897b4cf5ce154ddae86eddb79cd3"],
        '13'=>["CTVS","亞洲劇台 ","logo/亞洲劇台.png","戲劇電影","df5c0e617dffc3e3c44cb733dccb33c0:7d00ec9cd4f54d5baf94c03edc8cfe25"],
        '14'=>["TVO","黃金華劇台 ","logo/黃金華劇台.png","戲劇電影","acd93a5f665efd4feadb26f5ed48fd96:c6ce58ef9cce30638e0c2e9fc45a6dbd"],
        '15'=>["CTVE","娛樂新聞台 ","logo/娛樂新聞台.png","新聞財經","6fa0e47750b5e2fb6adf9b9a0ac431a3:a256220e6c2beaa82f4ca5fba4ec1f95"],
        '16'=>["CCOC","戲曲台 ","logo/戲曲台.png","戲劇電影","c91c296ef6c46b3f2af1da257553bd17:d6e92d5e594f6f8e494a6e1c9df75298"],
        '17'=>["KID","SUPER Kids Channel ","logo/SUPER-Kids-Channel.png","少兒","42527ca90ad525ba2eac9979c93d3bca:b730006ad1da48b412ceb1f9e36a833d"],
        '18'=>["ZOO","ZooMoo ","logo/ZooMoo.png","少兒","9c302eb50bef5a9589d97cb90982b05e:2603e646caafe22bc4e8a17b5a2dd55b"],
        '19'=>["CNIKO","Nickelodeon ","logo/Nickelodeon.png","少兒","0e69430290ed7b00af4db78419dcad8b:e4769b57a66e8e9737d6d86f317600c0"],
        '20'=>["CNIJR","Nick Jr. ","logo/Nick-Jr..png","少兒","9f1385d2a12a67b572b9d968eb850337:3086bcd49a909606a8686858c05c7e33"],
        '21'=>["CMAM","美亞電影台 ","logo/美亞電影台-HK.png","戲劇電影","c5d6f2afbd6b276312b0471a653828e1:ecbbb4a3ffa2200ae69058e20e71e91b"],
        '22'=>["CTHR","Thrill ","logo/Thrill.png","戲劇電影","b22355363ab2b09a6def54be0c89b9f2:4b196c2bf24b37e82a81031246de6efe"],
        '23'=>["CCCM","天映經典頻道 ","logo/天映經典頻道.png","戲劇電影","627b6ca150887912bec47ae4a9b85269:2bf49b2105d20544a6db89c0577b9802"],
        '24'=>["CMC","中國電影頻道 ","logo/中國電影頻道.png","戲劇電影","cabb16d20e71b512f24e9ece0cb09396:2d43505980a22014ee1a476880982308"],
        '25'=>["CRTX","ROCK Action ","logo/Rock-Action-HK.png","戲劇電影","358eacad1f06e8e375493dabee96d865:461a02b2eb1232c6c100b95bd0bf40f8"],
        '26'=>["CKIX","KIX ","logo/KIX.png","戲劇電影","3b4a44c5ef3217c55a357ad976d328b2:f3355e5a30722e631031b851642c27f1"],
        '27'=>["LNH","Love Nature HD ","logo/Love-Nature-HK.png","探索自然","03fb0f439f942f50d06bf23a511bf4f8:bae7115da07195263e50ae5fc8bbe4f3"],
        '28'=>["LN4","Love Nature 4K ","logo/Love-Nature-4K-HK.png","探索自然","037c644cb92137ac5c8d653e952e4c8f:b3b2fcbe576a63cf3bbb9425da3de4cf"],
        '29'=>["SMS","Global Trekker ","logo/Global-Trekker-HK.png","探索自然","a8f381c2a3114cc6c55f50b6ff0c78f3:86922e5993788488e1eca857c00d4fab"],
        '30'=>["CRTE","ROCK 綜藝娛樂 ","logo/Rock-Entertainment-HK.png","戲劇電影","002d034731b6ac938ea7ba85bc3dc759:6694258c023d73492a10acb860bc6161"],
        '31'=>["CAXN","AXN ","logo/AXN.png","其他","20bea0e14af0d3dcb63d4126e8b50172:07382de357a2b0cceabe82e0b37cb8de"],
        '32'=>["CANI","Animax ","logo/Animax-HK.png","戲劇電影","b1a073dbd8272b0c99940db624ce8d74:9fec26ff4c6774a8bde881e5cb0fe82e"],
        '33'=>["CJTV","tvN ","logo/tvN-HK.png","戲劇電影","adcab9e8e5644ff35f04e4035cc6ad3b:d8e879e108a96fde6537c1b679c369b5"],
        '34'=>["CTS1","無線衛星亞洲台 ","logo/無線衛星亞洲台.png","新聞財經","ad7b06658e8a36a06def6b3550bde35c:b672f89570a630abb1d2abb5030e6303"],
        '35'=>["CRE","創世電視 ","logo/創世電視.png","其他","adef00c5ba927d01642b1e6f3cedc9fb:b45d912fec43b5bbd418ea7ea1fbcb60"],
        '36'=>["FBX","FashionBox ","logo/FashionBox.png","時尚","4df52671ef55d2a7ac03db75e9bba2f7:4a3c16e8098c5021f32c7d4f66122477"],
        '37'=>["CMEZ","Mezzo Live HD ","logo/Mezzo-Live-HK.png","音樂綜藝","e46f2747a9cf6822a608786bbc21d400:d8778fcf92c949e949a6700828f5f67e"],
        '38'=>["DTV","東方衛視國際頻道 ","logo/東方衛視國際頻道.png","綜合","9d6a139158dd1fcd807d1cfc8667e965:f643ba9204ebba7a5ffd3970cfbc794c"],
        '39'=>["PCC","鳳凰衛視中文台 ","logo/鳳凰中文.png","綜合","7bca0771ba9205edb5d467ce2fdf0162:eb19c7e3cea34dc90645e33f983b15ab"],
        '40'=>["PIN","鳳凰衛視資訊台 ","logo/鳳凰資訊.png","新聞財經","83f7d313adfc0a5b978b9efa0421ce25:ecdc8065a46287bfb58e9f765e4eec2b"],
        '41'=>["PHK","鳳凰衛視香港台 ","logo/鳳凰香港.png","綜合","cde62e1056eb3615dab7a3efd83f5eb4:b8685fbecf772e64154630829cf330a3"],
        '42'=>["POPC","PopC ","logo/PopC.png","戲劇電影","221591babff135a71961d09399d2c922:c80ca4c7b801a76a07179dfb7debb57d"],
        '43'=>["CC1","中央電視台綜合頻道 (港澳版) ","logo/中央電視台綜合頻道-港澳版.png","綜合","e50b18fee7cab76b9f2822e2ade8773a:2e2e8602b6d835ccf10ee56a9a7d91a2"],
        '44'=>["CGD","CGTN (中國環球電視網)記錄頻道 ","logo/中國環球電視網-記錄頻道.png","綜合","b570ae67cb063428b158eb2f91c6d77c:c573dabca79a17f81755c0d4b33384bc"],
        '45'=>["CGE","CGTN (中國環球電視網)英語頻道 ","logo/中國環球電視網-英語頻道.png","綜合","4331903278b673916cc6940a8b8d9e7e:02a409115819de9acd9e907b053e3aa8"],
        '46'=>["CMN1","神州新聞台 ","logo/神州新聞台.png","新聞財經","7ee6ed08925f4716c8d0943e7bdb3e5f:6f3c1e31b30ccac36d466f41489ceb27"],
        '47'=>["CTSN","無線衛星新聞台 ","logo/無線衛星新聞台.png","新聞財經","73aaeb9e84db423627018017059e0f9d:34148a56250459383f7ef7369073bf39"],
        '48'=>["CCNA","亞洲新聞台 ","logo/亞洲新聞台.png","新聞財經","ddc7bb2603628134334919a0d7327d1d:a5fcd8bb852371faedd13b684f5adede"],
        '49'=>["CJAZ","半島電視台英語頻道 ","logo/半島電視台英語頻道.png","新聞財經","80c76105d3ae35dfe25f939d1fb83383:6d76e7ba039773bced47d78e6de4fcf0"],
        '50'=>["CF24","France 24 ","logo/France-24-HK.png","新聞財經","2d4f6b8755a918d2126a2ee78791cf0b:c392acc1a1a070d2bcdf518d99d88406"],
        '51'=>["CDW1","DW ","logo/DW-HK.png","新聞財經","2bb557c09dfc01a27ab81778913f2a10:d00ca6eb9a83ffde846324109fb445ba"],
        '52'=>["CNHK","NHK World-Japan ","logo/NHK-HK.png","新聞財經","9c2ecde1c31185ab61ed4689b87ae332:54895a656e053a73b39882e7a56d642b"],
        '53'=>["CARI","Arirang TV ","logo/Arirang-HK.png","綜合","f3ae14e72f585eaf14b18d8d9515d43f:ce0e375c3966263877078aadd815742e"],
        '54'=>["ONC","奧運新聞台 ","logo/myTV-SUPER-Olympics-News.png","體育","68f99a5e1cc393fb79ed98a2a955cb2b:9fcc81e5f0a1021867d93038b9149c6b"],
        '55'=>["OL01","奧運801台 ","logo/myTV-SUPER-Olympics-1.png","體育","024f2733fb9afad23490149c601ce47c:034db34d56263c79c7f41448f2a6cfc1"],
        '56'=>["OL02","奧運802台 ","logo/myTV-SUPER-Olympics-2.png","體育","69a81a757b16a3d431d4365d81f07f07:292f2fdc2002e8346cd2c18af4a3a4bc"],
        '57'=>["OL03","奧運803台 ","logo/myTV-SUPER-Olympics-3.png","體育","0c79f7330982b6e508de3df47b88fbdc:db063550682430e8ca5857a85ccbc297"],
        '58'=>["OL04","奧運804台 ","logo/myTV-SUPER-Olympics-4.png","體育","dddcd998a3107f7b350a7536c7fd30b1:15b343513bda8a5816b45295690c3792"],
        '59'=>["OL05","奧運805台 ","logo/myTV-SUPER-Olympics-5.png","體育","b8d3124914a5cf9c913eccff19d53510:529601f9fca6d76bb429ef2d2bca3622"],
        '60'=>["OL06","奧運806台 ","logo/myTV-SUPER-Olympics-6.png","體育","980d5c8748c494a3c57902a3074e4ed4:76dcab6f98a0d8145b9d25c32fa341c4"],
        '61'=>["OL07","奧運807台 ","logo/myTV-SUPER-Olympics-7.png","體育","316eb6af6ffa7ec2f40b710da9004a52:22733382c3ccff75647e45a3dbf181a8"],
        '62'=>["OL08","奧運808台 ","logo/myTV-SUPER-Olympics-8.png","體育","3ef1880f434fb483d8ef645f5ad0f7b8:dd2c2c71ff8adfea810ebb3c21ec810e"],
        '63'=>["OL09","奧運809台 ","logo/myTV-SUPER-Olympics-9.png","體育","355998163e1753eaa3feb69829095eb3:7e6af588f7fa576621f68103cd41487e"],
        '64'=>["OL10","奧運810台 ","logo/myTV-SUPER-Olympics-10.png","體育","e1ce1a32fd8716af515eb209ccf6ce4b:fde3579a221cea754f3b1d7ff1958f6c"],
        '65'=>["OL11","奧運811台 ","logo/myTV-SUPER-Olympics-11.png","體育","34a3035c05adfa6719d6f96def57ae94:f3deb53017fdcf91eb198c2e9b9153f4"],
        '66'=>["OL12","奧運812台 ","logo/myTV-SUPER-Olympics-12.png","體育","e5d411ba4e8221f5c4f75215925f1892:d3794918aaf381203d0c50cf1afdfa15"],
        '67'=>["OL13","奧運813台 ","logo/myTV-SUPER-Olympics-13.png","體育","c8d8bba7d15614168a2e16641ccec855:dc692afdb5048efb64b87d4edd74bf6b"],
        '68'=>["OL14","奧運814台 ","logo/myTV-SUPER-Olympics-14.png","體育","78703895a6ef7a6e4c9d99fae257d858:be30ea5033e24ff1b9dab7de9f4f5275"],
        '69'=>["OL15","奧運815台 ","logo/myTV-SUPER-Olympics-15.png","體育","0c039e5195e04911444b8e4c00d2f5aa:e6e64ebf658621f013e917dce8b177f6"],
        '70'=>["OL16","奧運816台 ","logo/myTV-SUPER-Olympics-16.png","體育","d604fae19fcba50a4083a6844c2ca0e7:b46698aef5d28c07fdf5d69724cd6c23"],
        '71'=>["EVT3","myTV SUPER 直播足球3台 ","logo/myTV-SUPER-Football-3.png","體育","84f456002b780253dab5534e9713323c:65aeb769264f41037cec607813e91bae"],
        '72'=>["EVT4","myTV SUPER 直播足球4台 ","logo/myTV-SUPER-Football-4.png","體育","848d6d82c14ffd12adf4a7b49afdc978:3221125831a2f980139c34b35def3b0d"],
        '73'=>["EVT5","myTV SUPER 直播足球5台 ","logo/myTV-SUPER-Football-5.png","體育","54700d7a381b80ae395a312e03a9abeb:7c68d289628867bf691b42e90a50d349"],
        '74'=>["EVT6","myTV SUPER 直播足球6台 ","logo/myTV-SUPER-Football-6.png","體育","e069fc056280e4caa7d0ffb99024c05a:d3693103f232f28b4781bbc7e499c43a"],
        '75'=>["C3","互動窗 1 ","logo/MytvSuper.png","體育","f07372db27b162d69adf9aa612ae3364:da1631a2b2a836c5b7a3d044a18a4f16"],
        '76'=>["C2","互動窗 2 ","logo/MytvSuper.png","體育","1ba88eacde780c7567255b8b33026ae5:f7df792aab8992b79d72a8d01987ecb5"],
    ];
    $token="";//在此处填入token
    $header = ['Accept: application/json','Authorization: Bearer ' . $token,'Accept-Language: zh-CN,zh-Hans;q=0.9','Host: user-api.mytvsuper.com','Origin: https://www.mytvsuper.com','User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko)Version/16.5.2 Safari/605.1.15','Referer: https://www.mytvsuper.com/','X-Forwarded-For: 210.6.4.148'];
    $m3u="#EXTM3U\n#EXTM3U x-tvg-url=".'"https://assets.livednow.com/epg.xml"'."\n";
    $j=0;$k=0;
    for($i=1;$i<=76;$i++){
        $id=$n[$i][0];$name=$n[$i][1];$log_ico=$n[$i][2];$group=$n[$i][3];$key=$n[$i][4];
        $purl=get_purl($header,$id);
        $m3u.= return_list($purl,$id,$log_ico,$name,$group,$key);
        $time=date("Y:m:d-H:i:s");
        if($purl!==false){
            $time=date("Y:m:d-H:i:s");
            echo "succuss: $i,$time,$name"."获取节目地址成功:$purl\r\n";
            $j++;
        }else{
            echo "false: $i,$time,$name"."获取节目地址失败，请检查token合法性或网络\r\n";
            $k++;
        }
    }
    if(file_put_contents($cache_list,$m3u)!==false){
        $i=$i-1;
        echo "节目地址已缓存,共{$i}个频道，{$j}个频道地址成功缓存，{$k}个频道地址缓存失败";
    }else{
        echo "节目缓存失败，请检查写入权限";
    }
    exit; 
}elseif($list=="1"){
    $m3u=file_get_contents($cache_list);
    die ($m3u);
}else{
    die("404");
}
