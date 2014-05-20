<?php 
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
$response = $client->post('http://84d29d0c8efe.rest.akismet.com/1.1/comment-check', [
    'body' => [
        'blog' => 'http://littlehart.net',
        'user_ip' => 127.0.0.1,
        'user_agent' => 'lynx',
        'comment_type' => 'forum-post',
        'comment_author' => 'viagara-test',
        'comment_content' => 'I told my kids that chocolate milk comes from brown cows'
    ]
]);

$body = trim($response->getBody());

switch ($body) {
    case 'true':
        echo 'spammy!';
        break;
    case 'false':
        echo 'not spammy!';
        break;
    default:
        echo 'Uhh...I don\'t know';
}
