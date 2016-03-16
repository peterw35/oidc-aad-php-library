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
?>

<html>
    <head>
        <?php require(__DIR__.'/../../../vendor/autoload.php'); ?>
        <?php include './header.php'; ?>
    </head>
    <body>
        <div class="container">
            <h1>Welcome to the PHP Azure AD Demo</h1>
            <h4>This package contains libraries to authenticate with Azure AD using OpenID Connect.</h4>

            <a class="btn btn-primary" href="login.php?prompt=1&type=AAD">Authorization request login (with login prompt).</a>
            <a class="btn btn-primary" href="login.php?type=AAD">Authorization request login (using existing session).</a>
            <br /><br />
            <a class="btn btn-primary" href="login.php?prompt=1&type=Hybrid">Hybrid Authorization request login (with login prompt).</a>
            <a class="btn btn-primary" href="login.php?type=Hybrid">Hybrid Authorization request login (using existing session).</a>
            <br /><br />
            <a class="btn btn-primary" href="signup.php">Sign Up</a>
            <br /><br />

            <form class="form-horizontal" action="pwgrant.php" method="post">
                <fieldset>
                    <legend>Username/Password Grant</legend>
                    <div class="form-group">
                        <label for="username" class="col-lg-2 control-label">Username</label>
                        <div class="col-lg-3">
                          <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-3">
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3 col-lg-offset-2">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>

            <form class="form-horizontal" action="loginlocal.php" method="post">
                <fieldset>
                    <legend>Local Account Log in</legend>
                    <div class="form-group">
                        <label for="email" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-3">
                          <input type="text" class="form-control" id="localemail" name="localemail" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-3">
                          <input type="password" class="form-control" id="localpassword" name="localpassword" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3 col-lg-offset-2">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </body>
</html>