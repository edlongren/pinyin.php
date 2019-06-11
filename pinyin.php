<?php
require_once('pinyin_table.php');

/**
 * 汉字转拼音函数
 * Author: edlongren@gmail.com 
 *
 * @param string $s         汉字字符串
 * @param bool $quanpin     是否全拼
 * @param bool $daxie       首字母是否大写
 * @param string $split     分隔符
 * @return string
 */


function pinyin_asi2py($a) {
    global $pinyin_table;
    foreach ($pinyin_table as $kk=>$pp) {
    	if (array_search($a, $pp)) {
    		return $kk;
    	}
    }
}

function get_pinyin($s, $quanpin = true, $daxie = false, $split = "") {
	if($split){ $quanpin=true; }//有分隔符，强制全拼
    $s = preg_replace("/\s/is", "_", $s);
    $s = preg_replace("/(|\~|\`|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\-|\+|\=|\{|\}|\[|\]|\||\\|\:|\;|\"|\'|\<|\,|\>|\.|\?|\/|\\\|\_)/is", "", $s);
    $i = 0;
    $py = '';
    // 加入这一句，自动识别UTF-8
    if (strlen("拼音") > 4)
        $s = iconv('UTF-8', 'GBK', $s);
    if ($quanpin) {
        // 全拼
        for ($i = 0; $i < strlen($s); $i++) {
            if (ord($s[$i]) > 128) {
                $char = pinyin_asi2py(ord($s[$i]) + ord($s[$i + 1]) * 256);
                $py.=$char.$split;
                $i++;
            } else {
                $py.=$s[$i].$split;
            }
        }
    } else {
        // 首字母
        for ($i = 0; $i < strlen($s); $i++) {
            if (ord($s[$i]) > 128) {
                $char = pinyin_asi2py(ord($s[$i]) + ord($s[$i + 1]) * 256);
                $py .=$char[0];
                $i++;
            } else {
                $py .=$s[$i];
            }
        }
    }
    $py=trim($py,$split);
    // 判断是否输出小写字符
    return ($daxie == true ? $py : strtolower($py));
}