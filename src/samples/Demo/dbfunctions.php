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

require(__DIR__ . '/../../../vendor/autoload.php');

require('connect.php');

class dbfunctions {

    public function isUserExist($emailid) {
        $query = "SELECT * FROM Users WHERE email = '" . $emailid . "'";
        return mysqli_fetch_array(mysqli_query($GLOBALS['connection'], $query), MYSQLI_ASSOC);
    }

    public function insertUser($firstname, $lastname, $email, $password) {

        $query = "INSERT INTO `Users` (firstname, lastname, password, email) "
                . "VALUES ('$firstname', '$lastname', '$password', '$email')";
        $result = mysqli_query($GLOBALS['connection'], $query);
        return mysqli_insert_id($GLOBALS['connection']);
    }

    public function verifyUser($email, $password) {
        $query = "SELECT * FROM Users WHERE email = '$email' and password = '$password'";
        return mysqli_fetch_array(mysqli_query($GLOBALS['connection'], $query), MYSQLI_ASSOC);
    }

    public function getAdUser($id) {
        $query = "SELECT * FROM AdUsers WHERE userId = " . $id;
        return mysqli_fetch_array(mysqli_query($GLOBALS['connection'], $query), MYSQLI_ASSOC);
    }

    public function insertAdUser($tokenparams, $userId, $token_type) {

        if ($token_type == 'id_token') {
            $query = "INSERT INTO `AdUsers` (userId , idTokenResponse) "
                    . "VALUES ('$userId', '$tokenparams')";
        } else {
            $encodedtokenparams = @json_encode($tokenparams, true);
            $query = "INSERT INTO `AdUsers` (userId , accessTokenResponse) "
                    . "VALUES ('$userId', '$encodedtokenparams')";
        }

        return mysqli_query($GLOBALS['connection'], $query);
    }

    public function getUser($userId) {
        $query = "SELECT * FROM users WHERE id = " . $userId;
        return mysqli_fetch_array(mysqli_query($GLOBALS['connection'], $query), MYSQLI_ASSOC);
    }

    public function getUserByEmail($emailId) {
        $query = "SELECT * FROM users WHERE email = '" . $emailId . "'";
        return mysqli_fetch_array(mysqli_query($GLOBALS['connection'], $query), MYSQLI_ASSOC);
    }

    public function unlinkAdUser($userid) {
        $query = "DELETE from AdUsers where userId = " . $userid;
        return mysqli_query($GLOBALS['connection'], $query);
    }

}
