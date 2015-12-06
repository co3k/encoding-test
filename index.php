<?php

$candidate = ['euc-jp', 'shift_jis', 'utf-8'];
$default = 'utf-8';

$encoding = (isset($_GET['encoding']) && in_array(strtolower($_GET['encoding']), $candidate)) ? strtolower($_GET['encoding']) : $default;
$text = [
    '水馬赤いなあいうえお　浮藻に小エビも泳いでる',
    '柿の木栗の木かきくけこ　キツツキこつこつ枯れけやき',
    '大角豆に酢をかけさしすせそ　その魚浅瀬で刺しました',
    '立ちましょ喇叭でたちつてと　トテトテタッタと飛び立った',
    '蛞蝓のろのろなにぬねの　納戸にぬめってなにねばる',
    '鳩ポッポほろほろはひふへほ　日向のお部屋にゃ笛を吹く',
    'まいまいネジまきまみむめも　梅の実落ちても見もしまい',
    '焼栗ゆで栗やいゆえよ　山田に灯のつくよいの家',
    '雷鳥は寒かろらりるれろ　蓮花が咲いたら瑠璃の鳥',
    'わいわいわっしょいわゐうゑを　植木屋井戸がえお祭りだ',
];
$iana_php_encoding_map = [
    'euc-jp' => 'EUC-JP',
    'shift_jis' => 'SJIS',
    'utf-8' => 'UTF-8',
];

$php_encoding = $iana_php_encoding_map[$encoding];
$h = function ($str) use ($php_encoding) {
    return htmlspecialchars(mb_convert_encoding($str, $php_encoding, 'utf-8'), ENT_QUOTES | ENT_XHTML | ENT_DISALLOWED, $php_encoding);
};

header('Content-Type: text/html; charset='.$encoding);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/XHTML1/DTD/XHTML1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $h($encoding) ?>" />
<title><?php echo $h($encoding) ?> 表示サンプル</title>
<meta name="description" content="<?php echo $h(implode(' / ', $text)) ?>" />
</head>
<body>
<?php foreach ($text as $p): ?>
<p><?php echo $h($p) ?></p>
<?php endforeach; ?>
</body>
</html>
