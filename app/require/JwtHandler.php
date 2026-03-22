<?php 
class JwtHandler {
    // JWT avec variable d'environement .en et git igniore 
    private string $secret; 
    public function __construct() {
        $this->secret = jwt_secret;
    }

    // Encoder une chaîne en base64 URL
    public function base64UrlEncode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    // Décoder une chaîne encodée en base64 URL
    public function base64UrlDecode($data) {
        // Ajouter des '=' pour compléter le padding si nécessaire
        $remainder = strlen($data) % 4;
        if ($remainder) {
            $padLen = 4 - $remainder;
            $data .= str_repeat('=', $padLen);
        }
        return base64_decode(strtr($data, '-_', '+/'));
    }

    // Generer un token JWT
    public function generateToken(array $payload): string {
        // En-tête du token
        $header = ['typ' => 'JWT', 'alg' => 'HS256'];

        // Encodage en base64 URL du header et du payload
        $headerEncoded = $this->base64UrlEncode(json_encode($header));
        $payloadEncoded = $this->base64UrlEncode(json_encode($payload));

        // Création de la signature
        $signature = hash_hmac('sha256', "$headerEncoded.$payloadEncoded", $this->secret, true);
       
        // Encodage de la signature
       $signatureEncoded = $this->base64UrlEncode($signature);

        return "$headerEncoded.$payloadEncoded.$signatureEncoded";
    }

    // Valider un token JWT
    public function validateToken(string $jwt): array {
        // Séparer les parties du token
        $parts = explode('.', $jwt);
        // Le token doit avoir 3 parties
        if (count($parts) !== 3) {
            return ['success' => false, 'message' => 'Format invalide'];
        }

        // Vérifier la signature et l'expiration du token 
        list($headerEncoded, $payloadEncoded, $signatureEncoded) = $parts;

        // Décoder la signature
        $signatureProvided = $this->base64UrlDecode($signatureEncoded);
        // Recréer la signature pour vérifier
        $expectedSignature = hash_hmac('sha256', "$headerEncoded.$payloadEncoded", $this->secret, true);

        // Comparer les signatures de manière sécurisée 
        if (!hash_equals($expectedSignature, $signatureProvided)) {
            // Les signatures ne correspondent pas
            return ['success' => false, 'message' => 'Signature invalide'];
        }

        // Décoder le payload
        $payload = json_decode($this->base64UrlDecode($payloadEncoded), true);
        // Vérifier l'expiration
        if (isset($payload['exp']) && time() > $payload['exp']) {
            // Le token a expiré
            return ['success' => false, 'message' => 'Token expiré'];
        }
        // Token valide
        return ['success' => true, 'data' => $payload];
    }
}