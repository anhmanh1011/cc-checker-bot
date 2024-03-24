<?php

function clean($message) {
    return htmlspecialchars(trim($message));
}

function random_strings($length_of_string) {
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZIJKLMNOP28427JEKUBKQOPDH';
    $str_shuffled = str_shuffle($str_result);
    return substr($str_shuffled, 0, $length_of_string);
}

if ((strpos($message, "/code") === 0) || (strpos($message, "!code") === 0) || (strpos($message, ".code") === 0)) {
    $owners = file_get_contents('Database/owner.txt');
    $admins = explode("\n", $owners);
    if (!in_array($userId, $admins)) {
        sendMessage($chatId, "@$username
        𝖸𝖮𝖴 𝖠𝖱𝖤 𝖭𝖮𝖳 𝖬𝖸  𝖮𝖶𝖭𝖤𝖱 𝖫𝖮𝖫 😂", $messageId);
    } else {
        $command = substr($message, 6);
        $command = clean($command);

        if ($command == ' ' || $command == '') {
            $expiryDays = 1;
            $amountOfCodes = 1;
        } else {
            $cmdExplode = explode('-', $command); // assuming the format is {expiry_days}-{amount_of_codes}
            $expiryDays = (int)$cmdExplode[0];
            $amountOfCodes = (int)$cmdExplode[1];
        }

        $expiryDate = date('d M Y', strtotime("+$expiryDays days")); // setting the key expiry date as provided by the owner

        $credt = array();
        while ($amountOfCodes > 0) {
            $rnds = 'CARD-3D-' . random_strings(4) . '-' . random_strings(4) . '-' . random_strings(4);
            $credt[] = $rnds;
            $amountOfCodes = $amountOfCodes - 1;
        }

        foreach ($credt as $code) {
            $credtf = fopen('Database/codes.txt', 'a');
            fwrite($credtf, "[$code|$expiryDays],\n");
            fclose($credtf);
            $formattedCode = "<code>$code</code>";
            $messageToSend = urlencode(
                "[⦿] 𝗕𝗢𝗧 𝗨𝗦𝗘𝗥𝗡𝗔𝗠𝗘 : @CARD3DBOT \n".
                "[⦿] 𝗞𝗘𝗬 𝗖𝗥𝗘𝗔𝗧𝗘𝗗 \n" .
                "[⦿] 𝗨𝗦𝗔𝗚𝗘 /redeem\n" .
                "[⦿] 𝗞𝗘𝗬 : $formattedCode\n" .
                "[⦿] 𝗗𝗔𝗬𝗦: $expiryDays\n" .
                "[⦿] 𝗧𝗛𝗘 𝗞𝗘𝗬 𝗘𝗫𝗣𝗜𝗥𝗘𝗗: $expiryDate\n" .
                "[⦿] 𝗥𝗔𝗡𝗞: 𝖯𝖱𝖤𝖬𝖨𝖴𝖬♻️"
            );
            sendMessage($chatId, $messageToSend, $messageId); // using $messageId instead of $message_id_1
        }
    }
}
?>
