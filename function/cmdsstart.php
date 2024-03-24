<?php


$users = file_get_contents('Database/free.txt');
$freeusers = explode("\n", $users);

$videoURLStart = "https://telegra.ph/file/50ee9606de7e5bdd3eef0.mp4";


if (preg_match('/^(\/start|\.start|!start)/', $text)) {
    if (in_array($userId, $freeusers)) {
        $caption = "<b> ʜᴇʟʟᴏ 👋 @$username 
🆔 <code>$userId</code></b><code>
ᴡᴇʟᴄᴏᴍᴇ ᴛᴏ ᴏᴜʀ ᴄᴄ ᴄʜᴇᴄᴋᴇʀ ʙᴏᴛ!, ᴠᴇʀɪғʏ ᴄʀᴇᴅɪᴛ ᴄᴀʀᴅ ᴅᴇᴛᴀɪʟs ɪɴsᴛᴀɴᴛʟʏ. Jᴜsᴛ sᴇɴᴅ ᴜs ᴛʜᴇ ᴄᴀʀᴅ ɴᴜᴍʙᴇʀ, ᴀɴᴅ ᴡᴇ'ʟʟ ᴅᴏ ᴛʜᴇ ʀᴇsᴛ. </code> <code>button</code> /cmds";
        sendVideox($chatId, $videoURLStart, $caption, $keyboard);
    } else {
        reply_tox($chatId,$message_id,$keyboard,"<code>You are not registered, Register first with</code> /register <code> to use me</code>");
    }
}
//=========START END========//
if (preg_match('/^(\/cmds|\.cmds|!cmds)/', $text)) {
  
    $videoUrl = "https://telegra.ph/file/50ee9606de7e5bdd3eef0.mp4"; 

    $keyboard2 = json_encode([
        'inline_keyboard' => [
            [
                ['text' => 'Gᴀᴛᴇs', 'callback_data' => 'gates'],
                ['text' => 'Tᴏᴏʟs', 'callback_data' => 'herr'],
                ['text' => 'Pʀɪᴄᴇ', 'callback_data' => 'price'],
            ],
            [
                ['text' => 'Fɪɴᴀʟɪᴢᴇ', 'callback_data' => 'finalize'],
            ],
            [
                ['text' => 'Oғғɪᴄɪᴀʟ Gʀᴏᴜᴘ', 'callback_data' => 'channel'],
            ],
        ]
    ]);

    $caption = "<b> ᴡᴇʟᴄᴏᴍᴇ ᴛᴏ sᴇᴄʀᴇᴛ ᴄᴏᴍᴍᴀɴᴅs sᴇᴄᴛɪᴏɴ  $firstname
    
ᴇxᴘʟᴏʀᴇ ᴍʏ sᴛᴜғғ 🌏</b>";
    file_get_contents("https://api.telegram.org/bot$botToken/deleteMessage?chat_id=$chatId&message_id=$messageId");

    // Using sendVideo endpoint instead of sendPhoto
    file_get_contents("https://api.telegram.org/bot$botToken/sendVideo?chat_id=$chatId&video=$videoUrl&caption=" . urlencode($caption) . "&parse_mode=HTML&reply_markup=$keyboard2");
}