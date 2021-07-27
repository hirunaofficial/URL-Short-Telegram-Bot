<?php
$token = 'BOT_TOKEN';
$img = 'BOT_IMG';

$input = file_get_contents('php://input');
$update = json_decode($input);
$send = $update->message->text;
$document = $update->message->document;
$chat_id = $update->message->chat->id;
$fname = $update->message->chat->first_name;
$lname = $update->message->chat->last_name;

$inlinebutton = array(
    "inline_keyboard" => array(array(array("text" => "\xE2\x9E\x95 Add me to Your Group", "url" => "https://t.me/ipstatisticsbot?startgroup=new")))
);

$keyboard = json_encode($inlinebutton, true);

$urllong = filter_var($send, FILTER_VALIDATE_URL);
if (strpos($send, "$urllong") === 0) {
$cleanuri = curl_init('https://cleanuri.com/api/v1/shorten');
$data = array(
  'url' => "$urllong",
);

curl_setopt($cleanuri, CURLOPT_POST, 1);
curl_setopt($cleanuri, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($cleanuri, CURLOPT_RETURNTRANSFER, true);

$geturl = curl_exec($cleanuri);
curl_close($cleanuri);

$decodeurl = json_decode($geturl);
$url = $decodeurl->result_url;

$urltext = urlencode("<b>\xF0\x9F\x94\x97 Link Shorten Bot \xF0\x9F\x94\x97\nLink - $url\n~ @LinkShortenRobot</b>");

file_get_contents("https://api.telegram.org/bot$token/sendphoto?chat_id=$chat_id&photo=$img&parse_mode=HTML&caption=$urltext");
}

if (strpos($send, "/start") === 0) {

$welcometext = urlencode("<b>\xF0\x9F\x94\x97 Link Shorten Bot \xF0\x9F\x94\x97</b>\n\n\xF0\x9F\x91\x8B Hey <b>$fname $lname</b> \xF0\x9F\x92\xAD I'm <b>Link Shorten Bot \xF0\x9F\x92\xAA I can Short your Long URL in Second</b> \xF0\x9F\x9A\x80\n\n<b>Send</b> the <b>Long URL</b> and get a <b>Short URL</b> Easily via <b>Link Shorten Bot</b> \xF0\x9F\x92\xA1\n<b>Ex - https://t.me/LinkShortenRobot (Send Direct Link)</b>\n\n<b>Send</b> /help to Get more Information About <b>Link Shorten Bot</b> \xE2\x9A\xA1\n\n<b>Developed by @hirunaofficial \xf0\x9f\x87\xb1\xf0\x9f\x87\xb0</b>");

file_get_contents("https://api.telegram.org/bot$token/sendphoto?chat_id=$chat_id&photo=$img&parse_mode=HTML&caption=$welcometext&reply_markup=$keyboard");
}

if (strpos($send, "/help") === 0) {
	
$helptext = urlencode("<b>\xF0\x9F\x94\x97 Link Shorten Bot \xF0\x9F\x94\x97</b>\n\n\xE3\x80\xBD <b>About Bot</b> \xE3\x80\xBD\n\n<b>\xE2\x96\xB6	Name</b> - Link Shorten Bot\n<b>\xE2\x96\xB6	Username</b> - @LinkShortenRobot\n<b>\xE2\x96\xB6	Created By</b> - @hirunaofficial\n\n<b>\xF0\x9F\x94\xA7 Bot Commands \xF0\x9F\x94\xA7</b>\n\n\xE2\x96\xB6	/start - Start Link Shorten Bot\n\xE2\x96\xB6	/help - More information about Link Shorten Bot");

file_get_contents("https://api.telegram.org/bot$token/sendphoto?chat_id=$chat_id&photo=$img&parse_mode=HTML&caption=$helptext&reply_markup=$keyboard");
}
?>