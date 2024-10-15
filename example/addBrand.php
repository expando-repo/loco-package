<?php
use Expando\LocoPackage\Request\BrandRequest;

require_once 'boot.php';

$app = new Expando\LocoPackage\App();
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
        $brand = new BrandRequest($_POST['connection_id'] ?? null);
        $brand->setIdentifier($_POST['identifier'] ?? null);
        $brand->setBrandId(intval($_POST['brand_id']) ?? null);
        $brand->setTitle($_POST['brand_title']);
        $brand->setDescription($_POST['brand_description'] ?? null);
        $brand->setSeoTitle($_POST['brand_seo_title'] ?? null);
        $brand->setSeoDescription($_POST['brand_seo_description'] ?? null);
        $brand->setSeoKeywords($_POST['brand_seo_keywords'] ?? null);
        $response = $app->send($brand);
    } catch (\Expando\LocoPackage\Exceptions\AppException $e) {
        die($e->getMessage());
    }

    echo 'Brand ID: ' . $response->getBrandId() . '<br/><br/>';
}
?>

<form method="post">
    <div>
        <label>Connection ID<br/>
            <input type="text" name="connection_id" value="<?php echo htmlspecialchars($_POST['connection_id'] ?? '') ?>"/>
        </label>
    </div>
    <div>
        <label>Brand ID<br/>
            <input type="text" name="brand_id" value="<?php echo $_POST['brand_id'] ?? null ?>"/>
        </label>
    </div>
    <div>
        <label>Identifier<br/>
            <input type="text" name="identifier" value="<?php echo htmlspecialchars($_POST['identifier'] ?? 'j4k2m1n3b4') ?>"/>
        </label>
    </div>
    <div>
        <label>Brand Title<br/>
            <input type="text" name="brand_title" value="<?php echo htmlspecialchars($_POST['brand_title'] ?? 'Dior') ?>"/>
        </label>
    </div>
    <div>
        <label>Brand Description<br/>
            <input type="text" name="brand_description" value="<?php echo htmlspecialchars($_POST['brand_description'] ?? 'Popis značky') ?>"/>
        </label>
    </div>
    <div>
        <label>Brand SEO Title<br/>
            <input type="text" name="brand_seo_title" value="<?php echo htmlspecialchars($_POST['brand_seo_title'] ?? 'Dior SEO Popis') ?>"/>
        </label>
    </div>
    <div>
        <label>Brand SEO Description<br/>
            <input type="text" name="brand_seo_description" value="<?php echo htmlspecialchars($_POST['brand_seo_description'] ?? 'Velký sortiment značky Dior') ?>"/>
        </label>
    </div>
    <div>
        <label>Brand SEO Keywords<br/>
            <input type="text" name="brand_seo_keywords" value="<?php echo htmlspecialchars($_POST['brand_seo_keywords'] ?? 'Dior,parfemy,šperky,kabelky') ?>"/>
        </label>
    </div>
    <div>
        <input type="submit" name="send" value="Send"/>
    </div>
</form>
