<?php

    use Expando\LocoPackage\Request\ProductRequest;
    use Expando\LocoPackage\Request\VariantRequest;

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
            $response = $app->getCategory($_POST['connection_id'], $_POST['category_id']);
        }
        catch (\Expando\LocoPackage\Exceptions\AppException $e) {
            die($e->getMessage());
        }

        echo '<strong>Title:</strong> ' . $response->getTitle() . '<br />';
        echo '<strong>Description:</strong> ' . $response->getDescription() . '<br />';
        echo '<strong>Description2:</strong> ' . $response->getDescription2() . '<br />';
        echo '<strong>Identifier:</strong> ' . $response->getIdentifier() . '<br />';
        echo '<strong>Seo Title:</strong> ' . $response->getSeoTitle() . '<br />';
        echo '<strong>Seo Description:</strong> ' . $response->getSeoDescription() . '<br />';
        echo '<strong>Seo Keywords:</strong> ' . $response->getSeoKeywords() . '<br />';
        echo '<strong>Menu title:</strong> ' . $response->getMenuTitle() . '<br />';
        echo '<strong>Status:</strong> ' . $response->getStatus() . '<br />';
        echo '-----------------------------<br />';
    }
?>

<form method="post">
    <div>
        <label>
            Connection ID<br />
            <input type="text" name="connection_id" value="<?php echo $_POST['connection_id'] ?? null ?>"  />
        </label>
    </div>
    <div>
        <label>
            Category ID<br />
            <input type="text" name="category_id" value="<?php echo $_POST['category_id'] ?? null ?>"  />
        </label>
    </div>
    <div>
        <input type="submit" name="send" value="send" />
    </div>
</form>
