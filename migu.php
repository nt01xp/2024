<?php
header('Content-Type: text/html; charset=utf-8');

class MiguParser
{
    /**
     * $channelList - migu 频道列表
     * @var array
     */
    private $channelList = [
        "央视频道" => [
            265183188 => "CCTV1",
            265667329 => "CCTV2",
            265667206 => "CCTV3",
            265667639 => "CCTV4",
            265667313 => "CCTV4欧洲",
            265667335 => "CCTV4美洲",
            265667565 => "CCTV5",
            265106763 => "CCTV5+",
            265667482 => "CCTV6",
            265667268 => "CCTV7",
            265667466 => "CCTV8",
            265667202 => "CCTV9",
            265667631 => "CCTV10",
            265667429 => "CCTV11",
            265667607 => "CCTV12",
            265667474 => "CCTV13",
            265667325 => "CCTV14",
            265667535 => "CCTV15",
            265667526 => "CCTV17",
            810326624 => "发现之旅",
            810326846 => "老故事",
            810326679 => "中学生",
            265218920 => "CGTN纪录",
            265218872 => "CGTN西语",
            265219154 => "CGTN阿语",
            265219025 => "CGTN法语",
            265218806 => "CGTN俄语",
            265667645 => "CHC家庭影院",
            265218967 => "CHC动作电影",
        ],

        "卫视频道" => [
            // 531261825 => "山东卫视",
            // 265667721 => "湖南卫视",
            // 531262033 => "重庆卫视",
            // 531261057 => "宁夏卫视",
            // 531261933 => "甘肃卫视",
            // 531261937 => "四川卫视",
            // 531261982 => "内蒙古卫视",
            // 531262095 => "新疆卫视",
            // 524854265 => "西藏卫视",
            264104266 => "东方卫视",
            531262154 => "吉林卫视",
            265669068 => "辽宁卫视",
            264104188 => "江苏卫视",
            531261978 => "湖北卫视",
            810783159 => "江西卫视",
            531262027 => "青海卫视",
            816409120 => "陕西卫视",
            263541274 => "广东卫视",
            531262161 => "海南卫视",
            265218882 => "大湾区卫视",
        ],


        "地区频道" => [
            265219146 => "江苏教育",
            265218942 => "山东教育",
            // 202812323 => "欢笑剧场",
            80891335 => "浙江数码时代",
            76680661 => "杭州综合",
            76680745 => "杭州影视",
            76680568 => "杭州西湖明珠",
            76680574 => "杭州生活",
            76680756 => "杭州少儿",
            932470412 => "嵊泗新闻综合",
            903589402 => "普陀电视台",
        ],

        "数字频道" => [
            265667494 => "四海钓鱼",
            265667664 => "游戏风云",
            265218862 => "高清大片",
            265219029 => "云上电影院",
            265218878 => "追剧少女",
            265218955 => "热剧联播",
            265218921 => "赛事最经典",
            265218759 => "体坛名栏汇",
            265218930 => "新片放映厅",
            140151866 => "Y+剧场",

            265667599 => "熊猫频道高清",
            265219065 => "熊猫频道1",
            265218959 => "熊猫频道2",
            265218910 => "熊猫频道3",
            265218991 => "熊猫频道4",
            265218689 => "熊猫频道5",
            265218934 => "熊猫频道6",
            265219037 => "熊猫频道7",
            265218971 => "熊猫频道8",
            265218886 => "熊猫频道9",
            265218794 => "熊猫频道10",
        ],
    ];

    /**
     * $dumpType - 输出格式 默认0=m3u 1=text
     * @var int
     */
    private $dumpType = 0;

    /**
     * $selfJumpUrl - 跳转地址，默认为空
     * @var string
     */
    private $selfJumpUrl = "";

    /**
     * 构造函数，用于初始化类实例时的m3u文件路径
     *
     * 该构造函数通过组合传入的主机名和端口号来形成一个m3u文件的URL该m3u文件
     * 通常用于定义一个播放列表，这里将其存储在类实例的m3uFile属性中
     *
     * @param int $dump_type - 输出格式，默认为0，用于设置输出格式，0=m3u，1=text
     * @param int $self_jump_url - 跳转地址，默认为空
     *
     */
    public function __construct($dump_type = 0, $self_jump_url = "")
    {
        // 设置输出格式
        $this->dumpType = $dump_type;
        // 设置跳转地址
        $this->selfJumpUrl = $self_jump_url;
    }

    private function dumpM3u()
    {
        $str = '#EXTM3U x-tvg-url="https://live.fanmingming.com/e.xml"' . PHP_EOL;
        foreach ($this->channelList as $group => $groupList) {
            foreach ($groupList as $channelId => $channelName) {
                $str .= sprintf('#EXTINF:-1 tvg-id="%s" tvg-name="%s" tvg-logo="https://live.fanmingming.com/tv/%s.png" group-title="%s",%s%s%s%s%s', $channelName, $channelName, $channelName, $group, $channelName, PHP_EOL, $this->selfJumpUrl, $channelId, PHP_EOL);
            }
        }
        return $str;
    }

    private function dumpText()
    {
        $str = "";
        foreach ($this->channelList as $group => $groupList) {
            $str .=  sprintf("%s,#genre#%s", $group, PHP_EOL);
            foreach ($groupList as $channelId => $channelName) {
                $str .= sprintf("%s,%s%s%s", $channelName, $this->selfJumpUrl, $channelId, PHP_EOL);
            }
        }
        return $str;
    }

    public function dumpContents()
    {
        if ($this->dumpType == 1) {
            return $this->dumpText();
        }
        return $this->dumpM3u();
    }
}

/**
 * $jump - 判断是否是需要跳转的链接
 */
$jumpChannelId = (isset($_GET['id']) && $_GET["id"]) ? trim($_GET["id"]) : '';
if ($jumpChannelId) {
    $htmlStr = file_get_contents("http://aikanvod.miguvideo.com/video/p/live.jsp?user=guest&channel={$jumpChannelId}");
    if (preg_match('/id="live_title"\svalue="([^"]+)".*source src="([^"]+)"/', $htmlStr, $matches)) {
        // var_dump($matches);
        header("Location: $matches[2]");
        exit;
    }
}

/**
 * $type - 输出类型 默认0=m3u 1=text
 */
$type = (isset($_GET['t']) && $_GET["t"] == 1) ? 1 : 0;
/**
 * $selfJumpUrl - 本页面的URL，用于跳转至本页面
 */
$selfJumpUrl = sprintf("%s://%s%s?id=", (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' && $_SERVER['SERVER_PORT'] == 443) ? 'https' : 'http', $_SERVER['HTTP_HOST'], $_SERVER['SCRIPT_NAME']);

$m3uParser = new MiguParser($type, $selfJumpUrl);

echo $m3uParser->dumpContents();
