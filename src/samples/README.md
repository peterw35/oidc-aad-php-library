# PHP ADAL Sample App:
This sample app demonstrates how to use the PHP ADAL library to implement connected accounts and various authentication flows.

## Installation instructions:
1. Install dependencies and generate autoloader with composer:
  * `curl -sS https://getcomposer.org/installer | php`
  * `php composer.phar install`
2. Copy storagedb.dist.sqlite to storagedb.sqlite (in the same folder):
  * Your webserver needs to write to both the the storagedb.sqlite file and the samples folder, so ensure permissions are set to allow this.
3. Copy config.dist.php to config.php (in the same folder).
4. Edit config.php and enter your client ID, client secret, and redirect URI.
  1. The redirect URI will be the URI that points to the redirect.php file in this folder, for example "http://example.com/src/samples/redirect.php". This will depend on your environment.
  2. The redirect URI entered in the config.php and in the Azure management portal must match exactly.
5. Visit the index.php page in your browser, for example http://example.com/src/samples/index.php
6. There are five options to demonstrate authentication flows.
  1. Authorization code flow (with login prompt): This is the common 3 legged OAuth2 flow. This will redirect you to the Office 365 login page and always ask you to log in, regardless of whether you are logged in to Office 365 or not.
  2. Authorization code flow (using existing session): This is the common 3 legged OAuth2 flow. This will use a preexisting session if present, othwerwise the same flow as above.
  3. Hybrid code flow (with login prompt): This is the quicker ID Token OAuth2 flow. This will redirect you to the Office 365 login page and always ask you to log in, regardless of whether you are logged in to Office 365 or not.
  4. Hybrid code flow (using existing session): This is the quicker ID Token OAuth2 flow. This will use a preexisting session if present, otherwise the same flow as above.
  5. Resource Owner Password Credentials Grant: This allows you to enter Office 365 login credentials directly in the login form and have authentication happen behind the scenes. You will not be redirected to Office 365 to log in.
7. You can also create local accounts to link to your Office 365 accounts using the "Sign Up" button and login to your local account using the local account login section. Once logged into your local account, you can link or unlink your Office 365 account with the local account.
