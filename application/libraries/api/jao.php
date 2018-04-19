<?php defined('BASEPATH') OR exit('No direct script access allowed');
class jao {
	protected $app;
    public function __construct() {
        $this->client = new \GuzzleHttp\Client([
        	'base_uri' => 'https://test.loopna.com/latest/omw/',
            'http_errors' => false,
            'headers' => [
			    'Content-Type' => 'application/json',
			    'Accept' => 'application/json',
			]
        ]);
    }
	public function signupJAO($data) {
		$endpoint = 'sign_up';
		$params = array(
			'fname' => $data['first_name'],
			'lname' => $data['last_name'],
			'phone' => $data['phone'], 
			'password' => $data['password'],
			'email' => (isset($data['email'])) ? $data['email'] : NULL
		);
		$request = $this->client->request('GET', $endpoint, [
			'query' => $params
		]);
		$response = array(
        	'status' => $request->getStatusCode(),
        	'body' => json_decode($request->getBody())
        );
        return $response;
	}
	public function is_signedinJAO($data) {
		$endpoint = 'check_if_already_login';
		$params = array(
			'mobile_number' => $data
		);
		$request = $this->client->request('GET', $endpoint, [
			'query' => $params
		]);
		$response = array(
        	'status' => $request->getStatusCode(),
        	'body' => json_decode($request->getBody())
        );
        return $response;
	}
	public function profileJAO($data) {
		$endpoint = 'get_profile_information';
		$params = array(
			'mobile_number' => $data
		);
		$request = $this->client->request('GET', $endpoint, [
			'query' => $params
		]);
		$response = array(
        	'status' => $request->getStatusCode(),
        	'body' => json_decode($request->getBody())
        );
        return $response;
	}
	public function tripsJAO($data) {
		$endpoint = 'get_trip_history';
		$params = array(
			'mobile_number' => $data
		);
		$request = $this->client->request('GET', $endpoint, [
			'query' => $params
		]);
		$response = array(
        	'status' => $request->getStatusCode(),
        	'body' => json_decode($request->getBody())
        );
        return $response;
	}
}