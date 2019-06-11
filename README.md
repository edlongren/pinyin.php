# pinyin.php
<p>PHP Pinyin / Chinese Pinyin / PHP 拼音函数<br />
汉字转拼音函数<br />
方便 SEO 网址用。<br />
调用简单。</p>


# 参数解释：
<p>
get_pinyin($s, $quanpin = true, $daxie = false, $split = "") <br />
string $s  输入文字<br />
bool $quanpin  1:全拼；2:首字母<br />
bool $daxie  1:大写；2:小写<br />
string $split  分隔符，默认为空。<br />
</p>

# 调用示例/DEMO：
```
说明：如果汉字大于10个，则只取首字母，否则用全拼，加中杠“-”分隔符。
include_once("pinyin.php"); 
$title="汉字转拼音函数";
if(mb_strlen($title)>10){
    $base_uri=get_pinyin($title,0);
}else{
    $base_uri=get_pinyin($title,"-");
}
```


End..

