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

namespace microsoft\adalphp\samples\Demo;

require(__DIR__.'/../../../vendor/autoload.php');

require('connect.php');

class dbfunctions { 
    public function  __construct() {}
    
    public function isUserExist($emailid){  
        $query = mysql_query("SELECT * FROM Users WHERE email = '".$emailid."'");  
        if(mysql_num_rows($query) > 0){  
            return true;  
        } else {  
            return false;  
        }
    }
    
    public function insertUser($firstname, $lastname, $email, $password){  
        
        $query = "INSERT INTO `Users` (firstname, lastname, password, email) "
            . "VALUES ('$firstname', '$lastname', '$password', '$email')";
        $result = mysql_query($query);
        
        return $result;
    }
    
    public function verifyUser($email, $password){
        $query = "SELECT * FROM Users WHERE email = '$email' and password = '$password'";
        $result = mysql_query($query);
        
        return $result;  
    }
    
    public function verifyAdUser($id){
        $query = "SELECT * FROM AdUsers WHERE userId = '$id'";
        $result = mysql_query($query);
        
        return $result;  
    }
}