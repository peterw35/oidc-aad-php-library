<?php
/**
 * Copyright (c) 2016 Micorosft Corporation
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author Aashay Zajriya <aashay@introp.net>
 * @license MIT
 * @copyright (C) 2016 onwards Microsoft Corporation (http://microsoft.com/)
 */
session_start();
require(__DIR__.'/../../../vendor/autoload.php');

// Construct.
$httpclient = new \microsoft\adalphp\HttpClient;
$storage = new \microsoft\adalphp\OIDC\StorageProviders\SQLite(__DIR__.'/../storagedb.sqlite');
$client = new \microsoft\adalphp\AAD\Client($httpclient, $storage);

// Set credentials.
require(__DIR__.'/../config.php');
if (!defined('ADALPHP_CLIENTID') || empty(ADALPHP_CLIENTID)) {
	throw new \Exception('No client ID set - please set in config.php');
}
$client->set_clientid(ADALPHP_CLIENTID);

if (!defined('ADALPHP_CLIENTSECRET') || empty(ADALPHP_CLIENTSECRET)) {
	throw new \Exception('No client secret set - please set in config.php');
}
$client->set_clientsecret(ADALPHP_CLIENTSECRET);

if (!defined('ADALPHP_CLIENTREDIRECTURI') || empty(ADALPHP_CLIENTREDIRECTURI)) {
	throw new \Exception('No redirect URI set - please set in config.php');
}
$client->set_redirecturi(ADALPHP_CLIENTREDIRECTURI);

// Make request.
$returned = $client->rocredsrequest($_POST['username'], $_POST['password']);

// Process id token.
$idtoken = \microsoft\adalphp\AAD\IDToken::instance_from_encoded($returned['id_token']);

$dbFunc = new \microsoft\adalphp\samples\Demo\dbfunctions;

$user = $dbFunc->isUserExist($idtoken->claim('upn'));

if ($user) {

    $adUser = $dbFunc->getAdUser($user['id']);

    if (!$adUser) {
        $dbFunc->insertAdUser($returned['id_token'], $user['id'], 'idtoken');
    }
} else {
    $dbFunc->insertUser($idtoken->claim('family_name'), $idtoken->claim('given_name'), $idtoken->claim('upn'), '');

    $user = $dbFunc->getUserByEmail($idtoken->claim('upn'));
    $dbFunc->insertAdUser($returned['id_token'], $user['id'], 'idtoken');
}

$_SESSION['logged_in'] = 1;
$_SESSION['user_id'] = $user['id'];
header('Location: /user.php');
?>