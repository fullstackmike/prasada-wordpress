<?php

namespace AsposeWordsExporter;

use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;

class Activation {

    public function register() {
        add_action("init", array($this, "callback"));
    }

    public function getToken() {
        if ($this->token !== null) {
            return $this->token;
        }

        if (!array_key_exists("token", $_REQUEST) || !get_option("aspose-cloud-activation-secret")) {
            return null;
        }

        try {
            $this->token = (new Parser())->parse($_REQUEST["token"]);
        } catch (Exception $x) {
            return null;
        }

        if (!($this->token->hasClaim("iss")) || $this->token->getClaim("iss") !== "https://activator.marketplace.aspose.cloud/") {
            return null;
        }

        $signer = new Sha256();
        $key = new Key(get_option("aspose-cloud-activation-secret"));
        if (!$this->token->verify($signer, $key)) {
            update_option("aspose-cloud-activation-secret", null);
            wp_die("Unable to verify token signature.");
        }

        return $this->token;
    }

    public function callback() {
        if (!($this->getToken())) {
            return;
        }

        if (!($this->getToken()->hasClaim("aspose-cloud-app-sid")) || !($this->getToken()->hasClaim("aspose-cloud-app-key"))) {
            wp_die("The token has some invalid data");
        }

        update_option("aspose-cloud-app-key", $this->getToken()->getClaim("aspose-cloud-app-key"));
        update_option("aspose-cloud-app-sid", $this->getToken()->getClaim("aspose-cloud-app-sid"));
        update_option("aspose-cloud-activation-secret", null);
        if (wp_redirect(admin_url("options-general.php?page=" . dirname(plugin_basename(ASPOSE_WORDS_EXPORTER_PLUGIN_FILE))))) {
            exit;
        }
    }

    private $token = null;

}
