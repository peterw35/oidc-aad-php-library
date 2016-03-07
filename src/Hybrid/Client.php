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

namespace microsoft\adalphp\Hybrid;

use \microsoft\adalphp\HttpClientInterface;
use \microsoft\adalphp\ADALPHPException;

class Client extends \microsoft\adalphp\OIDC\Client {

    /** @var string Auth endpoint. */
    protected $authendpoint = 'https://login.microsoftonline.com/common/oauth2/authorize';

    /** @var string Token endpoint. */
    protected $tokenendpoint = 'https://login.microsoftonline.com/common/oauth2/token';

    /** @var string The OIDC resource to use. */
    protected $resource = 'https://graph.windows.net';
    
    /**
     * Get an array of authorization request parameters.
     *
     * @param array $stateparams Parameters to store as state.
     * @param array $extraparams Additional parameters to send with the OIDC request.
     * @return array Array of request parameters.
     */
    protected function getauthrequestparams(array $stateparams = array(), array $extraparams = array()) {
        $nonce = str_replace('.', '', uniqid('', true));
        $nonce .= $this->get_random_string(41);

        $params = [
            'scope' => 'openid',
            'response_type' => 'code id_token',
            'client_id' => $this->clientid,
            'redirect_uri' => $this->redirecturi,
            'state' => $this->getnewstate($nonce, $stateparams),
            'response_mode' => 'form_post',
            'nonce' => $nonce,
            'resource' => $this->resource,
        ];
        $params = array_merge($params, $extraparams);
        return $params;
    }
    
     /**
     * Handle auth response.
     *
     * @param array $authparams Array of received auth response parameters.
     * @return array List of IDToken object, array of token parameters, and stored state parameters.
     */
    public function handle_id_token(array $authparams) {
        // Validate response.
        if (!isset($authparams['state'])) {
            throw new ADALPHPException($this->lang['unknownstate'], $authparams);
        }

        // Look up state.
        list($stateparams, $nonce) = $this->storage->get_state($authparams['state']);

        // Expire state record.
        $this->storage->delete_state($nonce);

        $idtoken = $this->process_idtoken($authparams['id_token'], $nonce);

        return [$idtoken, $stateparams];
    }
    
     /**
     * Construct an IDToken object from an encoded id_token string.
     *
     * @param string $idtoken An encoded id_token string.
     * @return \microsoft\adalphp\OIDC\IDTokenInterface An IDToken object.
     */
    protected function constructidtoken($idtoken) {
        $httpclient = new \microsoft\adalphp\HttpClient;
        $keys =  \microsoft\adalphp\AAD\IDToken::get_keys($httpclient);
        return \microsoft\adalphp\AAD\IDToken::instance_from_encoded($idtoken, $keys);
    }
}
