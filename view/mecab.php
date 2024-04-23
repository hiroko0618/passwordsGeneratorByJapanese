<?php
use Youaoi\MeCab\MeCab;
    MeCab::setDefaults([
    
        // PATHが通っていないmecabを起動させる時に設定(default: mecab)
        'command' => '~/.local/bin/mecab',
         
        // 独自の辞書ディレクトリを利用する場合に設定(default: null)
        //'dictionaryDir' => '~/.local/mecab-neologd',
        
        // 指定辞書を利用し解析。複数利用時はカンマ区切り(default: null)
        //'dictionary' => 'hoge1.dic,hoge2.dic',
        
        // 解析時に生成するMeCabWordのclass名を指定(default: Youaoi\\MeCab\\MeCabWord)
        //'wordClass' => User\\MeCab\\MeCabWord::class,
    ]);
function mecabParse($keyword) {
    #$options = array('-d', '/usr/local/lib/mecab/dic/mecab-ipadic-neologd');	
    #$mecab = new \MeCab\Tagger();
    #$nodes = $mecab->parseToNode($str);	
    
    #$command = 'echo "' . $keyword . '" | /usr/local/bin/mecab';
    #var_dump($command);
    #$output = [];
    #$error = '';

    #exec($command, $output, $error);

    #if (!empty($error)) {
    #    return 'MeCabエラー: ' . $error;
    #} else {
    #    return implode("\n", $output);
    #}
    var_dump($a = MeCab::parse('すもももももももものうち'));
    
    $mecab = new MeCab();
    
    var_dump($b = $mecab->analysis('すもももももももものうち'));
}
?>

