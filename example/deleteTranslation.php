<?php
    require_once 'boot.php';

    $app = new \Expando\LocoPackage\App();
    $app->setToken($_SESSION['app_token'] ?? null);
    $app->setUrl($_SESSION['client_data']['app_url']);
    if ($app->isTokenExpired()) {
        $app->refreshToken($_SESSION['client_data']['client_id'], $_SESSION['client_data']['client_secret']);
        if ($app->isLogged()) {
            $_SESSION['app_token'] = $app->getToken();
        }
    }

    if (!$app->isLogged()) {
        die('Translator is not logged');
    }

    if ($_POST['send'] ?? null) {
        try {
            $response = $app->deleteTranslation($_POST['language_icu'], (array) $_POST['product_id']);
        }
        catch (\Expando\LocoPackage\Exceptions\AppException $e) {
            die($e->getMessage());
        }

        echo 'Response: ' . ($response ? 'true' : 'false');

    }
?>

<form method="post">
    <div>
        <label>
            Language ICU<br />
            <input type="text" name="language_icu" value="<?php echo $_POST['language_icu'] ?? null ?>"  />
        </label>
    </div>
    <div>
        <label>
            Product ID<br />
            <input type="text" name="product_id" value="<?php echo $_POST['product_id'] ?? null ?>"  />
        </label>
    </div>
    <div>
        <input type="submit" name="send" value="send" />
    </div> 
</form>
