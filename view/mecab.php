<?php
function mecabParse($keyword) {
    $command = 'echo "' . $keyword . '" | /usr/local/bin/mecab';
    $output = [];
    $error = '';

    exec($command, $output, $error);

    if (!empty($error)) {
        return 'MeCabエラー: ' . $error;
    } else {
        return implode("\n", $output);
    }
}
?>

