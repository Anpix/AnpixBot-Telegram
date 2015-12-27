<?php

/**
 * Funções úteis
 */

require_once 'config.php';

function enviarMensagem($to, $text) {
    apiRequest('sendMessage', array('chat_id' => $to, 'text' => $text));
}

function salvaMensagem($rows) {
    
}

//$db = new PDO("{$db_type}:host={$db_host};dbname={$db_name}", $db_user, $db_pass);