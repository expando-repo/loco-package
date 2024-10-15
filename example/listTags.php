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
            $response = $app->listTags($_POST['connection_id'], $_POST['page'], $_POST['on-page']);
        }
        catch (\Expando\LocoPackage\Exceptions\AppException $e) {
            die($e->getMessage());
        }

        echo 'Tags count: ' . $response->getTotal() . '<br />';
        echo 'Current page: ' . $response->getCurrentPage() . '<br />';
        echo 'Status: ' . $response->getStatus() . '<br />';
        echo '-----------------------------<br />';

        echo '<ul>';
        foreach ($response->getTags() as $tag) {
            echo '<li><strong>Tag ID:</strong> ' . $tag->getTagId() . ' , 
            <strong>Identifier:</strong> ' . ($tag->getIdentifier() ?: '--') . ' ,
            <strong>Title:</strong> ' . ($tag->getTitle() ?: '--') . ' ,
            <strong>Description:</strong> ' . ($tag->getDescription() ?: '--') . ' ,
            <strong>Seo Title:</strong> ' . ($tag->getSeoTitle() ?: '--') . ' ,
            <strong>Seo Description:</strong> ' . ($tag->getSeoDescription() ?: '--') . ' ,
            <strong>Seo Keywords:</strong> ' . ($tag->getSeoKeywords() ?: '--') . ' ,
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
