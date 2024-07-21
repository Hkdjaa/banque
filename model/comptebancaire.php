<?php
class CompteBancaire {
    private $numero_compte;
    private $client_id;

    public function getNumeroCompte() {
        return $this->numero_compte;
    }

    public function setNumeroCompte($numero_compte) {
        $this->numero_compte = $numero_compte;
    }

    public function getClientId() {
        return $this->client_id;
    }

    public function setClientId($client_id) {
        $this->client_id = $client_id;
    }
}
?>
