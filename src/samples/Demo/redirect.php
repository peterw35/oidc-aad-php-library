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

require(__DIR__.'/../../../vendor/autoload.php');

// Construct.
$httpclient = new \microsoft\adalphp\HttpClient;
$storage = new \microsoft\adalphp\OIDC\StorageProviders\SQLite(__DIR__.'/../storagedb.sqlite');
if (!empty($_REQUEST['id_token'])) {
    $client = new \microsoft\adalphp\AAD\Clienthybrid($httpclient, $storage);
}
 else {
    $client = new \microsoft\adalphp\AAD\Client($httpclient, $storage);
}

// Set credentials.
require(__DIR__.'/config.php');
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

// Process response.
if (!empty($_REQUEST['id_token'])) {
    list($idtoken, $stateparams) = $client->handle_id_token($_REQUEST);
}
 else {
    list($idtoken, $tokenparams, $stateparams) = $client->handle_auth_response($_REQUEST);
}

// Output.
?>

<html>
    <head>
        <?php include './header.php'; ?>
    </head>
    <body>
        <div class="container">
            <br />
            <h1>Welcome to the PHP Azure AD Demo</h1>
            <h2>Hello, <?php echo $idtoken->claim('name').' ('.$idtoken->claim('upn').').' ?></h2>
            <h4>You have successfully authenticated with Azure AD using OpenID Connect. This is just a demo, but the libraries contained in this package will provide an OpenID Connect idtoken and an oAuth2 access token to use Azure AD APIs</h4>
            <a class="btn btn-primary" href="index.php">Click here start again.</a>
        </div>
    </body>
</html>