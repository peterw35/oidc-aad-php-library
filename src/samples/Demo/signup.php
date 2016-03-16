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

echo '<h1>Register</h1>';
echo '<form action="signupproc.php" method="POST">';
    echo '<p><label>User First Name : </label>';
    echo '<input id="firstname" type="text" name="firstname" placeholder="firstname" /></p>';
    
    echo '<p><label>User Last Name : </label>';
    echo '<input id="lastname" type="text" name="lastname" placeholder="lastname" /></p>';
    
    echo '<p><label>E-Mail : </label>';
    echo '<input id="email" type="email" name="email" placeholder="email" /></p>';
    
    echo '<p><label>Password : </label>';
    echo '<input id="password" type="password" name="password" placeholder="password" /></p>';

    echo '<input type="submit" name="submit" />';
echo '</form>';