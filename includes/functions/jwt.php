<?php
include_once 'time.php';
include_once 'hash.php';
include_once 'utils.php';

class JwtHeader {
    public $alg;
    public $typ;

    function __construct($_alg, $_typ) {
        $this->alg = $_alg;
        $this->typ = $_typ;
    }
}

class JwtPayload {
    public $sub;
    public $name;
    public $iss;
    public $iat;
    public $exp;

    function __construct($_sub, $_name, $_exp) {
        $this->sub = $_sub;
        $this->name = $_name;
        $this->iss = $_SERVER['HTTP_HOST'];
        $this->iat = get_current_datetime()->getTimestamp();
        $this->exp = $_exp;
    }
}

class JwtPayloadMessage {
    public $sub;
    public $name;

    function __construct($_sub, $_name) {
        $this->sub = $_sub;
        $this->name = $_name;
    }
}

function create_jwt($user_id, $user_name): string  {
    $jwt_header = base64_url_encode(json_encode(new JwtHeader("HS256", "JWT")));
    $jwt_body = base64_url_encode(json_encode(new JwtPayload($user_id, $user_name, get_current_datetime()->getTimestamp() + 2 * 24 * 60 * 60)));
    $jwt_signature = base64_url_encode(calc_hash_hmac($jwt_header . "." . $jwt_body));

    return $jwt_header . "." . $jwt_body . "." . $jwt_signature;
}

function verify_jwt($jwt): bool {
    $jwt_parts = explode(".", $jwt);
    $jwt_header = $jwt_parts[0];
    $jwt_body = $jwt_parts[1];
    $jwt_signature = $jwt_parts[2];

    $jwt_body_decoded = json_decode(base64_url_decode($jwt_body));
    $jwt_signature_decoded = base64_url_decode($jwt_signature);

    if (verify_hash_hmac($jwt_header . "." . $jwt_body, $jwt_signature_decoded)) {
        if ($jwt_body_decoded->exp > get_current_datetime()->getTimestamp()) {
            return true;
        }
    }

    return false;
}

function get_jwt_payload($jwt): JwtPayloadMessage {
    $jwt_parts = explode(".", $jwt);
    $jwt_body = json_decode(base64_url_decode($jwt_parts[1]));

    return new JwtPayloadMessage($jwt_body->sub, $jwt_body->name);
}