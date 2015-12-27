<?php

/**
 * Resumão Bot
 * http://telegram.me/resumao_bot
 * 
 * @author @jaonoctus
 * @author @anpix
 */

# Funções úteis
require_once 'functions.php';

# Variáveis
$t_chat_id          = $message['chat']['id'];
$t_chat_type        = $message['chat']['type'];
$t_message_date     = $message['chat']['date'];
$t_message_text     = $message['text'];
$t_user_name        = "{$message['from']['first_name']} {$message['from']['last_name']}";
$t_user_username    = $message['from']['username'];
$t_isPrivate        = ($chat_type == 'private')?true:false;
$t_isUserSet        = (!is_null($t_user_name))? /* if true */ : /* else */ ;
$fala               = array(
    'start' => "Olá, sou o bot que vai te ajudar a entender o que se passa no seu grupo.\nPara me adicionar em algum grupo, basta clicar no link abaixo:\n\nhttp://telegram.me/resumao_bot?startgroup=true"
);

# Verifica o tipo de chat
if ($t_isPrivate) {
    // Se o chat for privado
    switch ($t_message_text) {
        case strpos($t_message_text, '/start'):
            enviarMensagem($t_chat_id, $fala['start']);
            break;
        
        default:
            // nada
            break;
    }
} else {
    // Se o chat for um grupo
    
    # LIMPANDO A STRING
    $t_message_text = str_replace('@resumao_bot', '', $t_message_text);
    
    // Verifica se a mensagem é importante ou não
    //$importante = (strpos($t_message_text, '#importante'))?true:false;
    $importante = true;
    
    if ($importante) {
        // inserir mensagem no banco
        salvaMensagem($t_chat_type,$t_chat_id,$t_user_name,$t_message_text,$t_message_date,$t_isPrivate,$t_user_username);
        
        // retorna a msg pro chat
        enviarMensagem($t_chat_id, "Mensagem de {$t_user_name}");
    }
}

?>
