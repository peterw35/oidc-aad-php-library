<?php


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
}
