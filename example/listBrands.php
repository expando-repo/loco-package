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
            $response = $app->listBrands($_POST['connection_id'], $_POST['page'], $_POST['on-page']);
        }
        catch (\Expando\LocoPackage\Exceptions\AppException $e) {
            die($e->getMessage());
        }

        echo 'Brands count: ' . $response->getTotal() . '<br />';
        echo 'Current page: ' . $response->getCurrentPage() . '<br />';
        echo 'Status: ' . $response->getStatus() . '<br />';
        echo '-----------------------------<br />';

        echo '<ul>';
        foreach ($response->getBrands() as $brand) {
            echo '<li><strong>Brand ID:</strong> ' . $brand->getBrandId() . ' , 
            <strong>Identifier:</strong> ' . ($brand->getIdentifier() ?: '--') . ' ,
            <strong>Title:</strong> ' . ($brand->getTitle() ?: '--') . ' ,
            <strong>Description:</strong> ' . ($brand->getDescription() ?: '--') . ' ,
            <strong>Seo Title:</strong> ' . ($brand->getSeoTitle() ?: '--') . ' ,
            <strong>Seo Description:</strong> ' . ($brand->getSeoDescription() ?: '--') . ' ,
            <strong>Seo Keywords:</strong> ' . ($brand->getSeoKeywords() ?: '--') . ' ,
            </li>';
        }
        echo '</ul>';
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
            on page<br />
            <input type="text" name="on-page" value="<?php echo $_POST['on-page'] ?? 10 ?>"  />
        </label>
    </div>
    <div>
        <label>
            page<br />
            <input type="text" name="page" value="<?php echo $_POST['page'] ?? 1 ?>"  />
        </label>
    </div>
    <div>
        <input type="submit" name="send" value="send" />
    </div>
</form>
