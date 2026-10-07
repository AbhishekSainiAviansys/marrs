<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/JWT.php';

class Mathtab extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->config->load('mathtab');
    }

    // ✅ 1. Generate Token API
    public function generate_token() {

        $config = $this->config->item('mathtab');

        $privateKey = file_get_contents($config['private_key']);

        $payload = [
            "iss" => $config['issuer'],
            "aud" => $config['audience'],
            "sub" => "12345",
            "email" => "user@example.com",
            "name" => "John Doe",
            "iat" => time(),
            "exp" => time() + $config['expire_time']
        ];

        $jwt = JWT::encode($payload, $privateKey, 'RS256');

        echo $jwt;
    }

    // ✅ 2. Verify Token API
    public function verify_token() {

        $config = $this->config->item('mathtab');

        $publicKey = file_get_contents($config['public_key']);

        $authHeader = $this->input->get_request_header('Authorization');

        $token = str_replace('Bearer ', '', $authHeader);

        try {
            $decoded = JWT::decode($token, $publicKey, ['RS256']);
            print_r($decoded);
        } catch (Exception $e) {
            echo "Invalid Token: " . $e->getMessage();
        }
    }
}