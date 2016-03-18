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

if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
}

require(__DIR__ . '/../../../vendor/autoload.php');

$db = \microsoft\adalphp\samples\Demo\sqlite::get_db(__DIR__ . '/../storagedb.sqlite');

// Create required tables for first run.
$db->create_tables();
$error = '';
if (isset($_GET['local'])) {
    $user = $db->verify_user($_POST['localemail'], $_POST['localpassword']);
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: /user.php');
        die();
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<html>
    <?php include(__DIR__ .'./header.php'); ?>

    <div class="container">
        <?php if ($error != '') { ?>
            <div class="alert alert-danger" role="alert" style="margin-top: 30px">
                <h4><?php echo $error ?></h4>
            </div>
            <?php }
        ?>
        <div class="starter-template">
            <h1>Welcome to the PHP ADAL Demo</h1>
            <p class="lead">This package contains libraries to authenticate with Azure AD using OpenID Connect.</p>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">AAD Accounts</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                        <h3>Authorization Code Flow </h3>
                        <p><a class="btn btn-primary" href="login.php?prompt=1&type=AAD" role="button">With Login prompt »</a></p>
                        <p><a class="btn btn-primary" href="login.php" role="button">With Existing Session »</a></p>
                    </div>
                    <div class="col-lg-4">
                        <h3>Hybrid Flow</h3>
                        <p><a class="btn btn-primary" href="login.php?prompt=1&type=Hybrid" role="button">With Login prompt »</a></p>
                        <p><a class="btn btn-primary" href="login.php?type=Hybrid" role="button">With Existing Session »</a></p>
                    </div>
                    <div class="col-lg-4">
                        <h3>Resource Owner Password Credentials Grant</h3>
                        <form class="form-horizontal" action="pwgrant.php" method="post">
                            <fieldset>
                                <div class="form-group">

                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Office365 Email">
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-lg-10">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Office365 Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Local Accounts</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form class="form-horizontal" action="index.php?local=1" method="post">
                            <fieldset>
                                <legend>Log in</legend>
                                <div class="form-group">
                                    <label for="email" class="col-lg-3 control-label">Email</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="localemail" name="localemail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-lg-3 control-label">Password</label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control" id="localpassword" name="localpassword" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-3 col-lg-offset-3">
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <legend>Sign Up</legend>
                        <a href="/signup.php" class="btn btn-primary">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>