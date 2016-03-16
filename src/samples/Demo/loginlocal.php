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

namespace microsoft\adalphp\samples;

use microsoft\adalphp\samples;

require(__DIR__.'/../../vendor/autoload.php');

// Construct.
$dbFunc = new \microsoft\adalphp\samples\dbfunctions;

$result = $dbFunc->verifyUser($_POST['localemail'], $_POST['localpassword']);

if($result){
    // Output.
    echo '<h1>Welcome to the PHP Azure AD Demo</h1>';
    echo '<h2>Hello, '.mysql_result($result,0,1).' '.mysql_result($result,0,2).'. </h2>';
    echo '<h4>You have successfully authenticated with local account. ';
    
    $resultAdUser = $dbFunc->verifyAdUser(mysql_result($result,0,0));
    
    if(mysql_num_rows($resultAdUser) > 0)  {
        echo '<table border="1" style="width:100%">';
        echo '<tr>';
        echo '<th>User Id</th>';
        echo '<th>Access Token Response</th>';
        echo '<th>Id Token Response</th>';
        echo '</tr>';
        while($row = mysql_fetch_array($resultAdUser)) {
            echo '<tr>';
              echo '<td>'.$row['userId'].'</td>';
              echo '<td>'.$row['accessTokenResponse'].'</td>';
              echo '<td>'.$row['idTokenResponse'].'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    echo '<a href="index.php">Click here start again.</a>';
}