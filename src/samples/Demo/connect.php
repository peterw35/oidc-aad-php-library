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

global $connection;
// Set credentials.
require_once('/../config.php');
if (!defined('DB_HOST') || empty(DB_HOST)) {
	throw new \Exception('No DB HOST set - please set in config.php');
}

if (!defined('DB_USER') || empty(DB_USER)) {
	throw new \Exception('No DB USER set - please set in config.php');
}

if (!defined('DB_PASSWORD')) {
	throw new \Exception('No DB PASSWORD set - please set in config.php');
}

if (!defined('DB_DATABSE') || empty(DB_DATABSE)) {
	throw new \Exception('No DB DATABSE set - please set in config.php');
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$connection){
    die("Database Connection Failed" . mysql_error());
}
$select_db = mysqli_select_db($connection, DB_DATABSE);
if (!$select_db){
    die("Database Selection Failed" . mysql_error());
}