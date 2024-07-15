<?php
    require_once 'boot.php';

    if (empty($_SESSION['client_data'])) {
        header('Location: redirect.php');
        exit;
    }

    $app = new \Expando\LocoPackage\App();
    $app->setToken($_SESSION['app_token'] ?? null);
    $app->setUrl($_SESSION['client_data']['app_url']);
    if ($app->isTokenExpired()) {
        $app->refreshToken($_SESSION['client_data']['client_id'], $_SESSION['client_data']['client_secret']);
        if ($app->isLogged()) {
            $_SESSION['app_token'] = $app->getToken();
        }
    }
?>

<?php if (!$app->isLogged()) { ?>
    <a href="redirect.php">Login (get token)</a>
<?php } else { ?>
    <ul>
        <li><a href="addProduct.php">add/update product</a></li>
        <li><a href="listProducts.php">list products</a></li>
        <li><a href="changesProducts.php">changes products</a></li>
        <li><a href="getProduct.php">get product</a></li>
        <li><a href="commitProduct.php">commit product</a></li>
        <li><a href="deleteProduct.php">delete product</a></li>
        <li><a href="deleteTranslation.php">delete translation</a></li>
        <li><a href="listConnection.php">list connections</a></li>
        <li></li>
        <li><a href="logout.php">logout (delete token)</a></li>
    </ul>
<?php } ?>
