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
 * @author James McQuillan <james.mcquillan@remote-learner.net>
 * @license MIT
 * @copyright (C) 2016 onwards Microsoft Corporation (http://microsoft.com/)
 */

require(__DIR__.'/../../vendor/autoload.php');

echo '<h1>Welcome to the PHP Azure AD Demo</h1>';
echo '<h4>This package contains libraries to authenticate with Azure AD using OpenID Connect.</h4>';

echo '<a href="login.php?prompt=1">Authorization request login (with login prompt).</a><br />';
echo '<a href="login.php">Authorization request login (using existing session).</a><br />';
echo '<a href="loginhybrid.php?prompt=1">Hybrid Authorization request login (with login prompt).</a><br />';
echo '<a href="loginhybrid.php">Hybrid Authorization request login (using existing session).</a><br />';
echo '<a href="signup.php">Sign Up</a><br />';
echo '<br /><br /><h4>Username/Password Grant</h4>';
echo '<form action="pwgrant.php" method="post">';
echo '<label for="username">Username:</label> <input type="text" id="username" name="username" /><br />';
echo '<label for="password">Password:</label> <input type="password" id="password" name="password" /><br />';
echo '<input type="submit" name="submit" />';
echo '</form>';

echo '<br /><br /><h4>Local Account Log in</h4>';
echo '<form action="loginlocal.php" method="post">';
echo '<label for="email">Email:</label> <input type="text" id="localemail" name="localemail" /><br />';
echo '<label for="password">Password:</label> <input type="password" id="localpassword" name="localpassword" /><br />';
echo '<input type="submit" name="submit" />';
echo '</form>';