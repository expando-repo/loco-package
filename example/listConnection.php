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

    try {
        $response = $app->listConnections();

        echo 'Connections count: ' . count($response->getConnections()) . '<br />';
        echo 'Status: ' . $response->getStatus() . '<br />';
        echo '-----------------------------<br />';

        echo '<ul>';
        foreach ($response->getConnections() as $connection) {
            echo '<li><strong>Connection ID:</strong> ' . $connection->getConnectionId() . ', <strong>Title:</strong> ' . $connection->getTitle() . ', <strong>Language:</strong> ' . $connection->getLanguage() . ', <strong>Type:</strong> ' . ($connection->getType() ?: '--') . '</li>';
        }
        echo '</ul>';
    }
    catch (\Expando\LocoPackage\Exceptions\AppException $e) {
        die($e->getMessage());
    }
