<?php
use Expando\LocoPackage\Request\TagRequest; // Ujistěte se, že máte správný import pro TagRequest

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
        $tag = new TagRequest($_POST['connection_id'] ?? null); // Odpovídá za TagRequest
        $tag->setIdentifier($_POST['identifier']);
        $tag->setTitle($_POST['tag_title']);
        $tag->setDescription($_POST['tag_description'] ?? null);
        $tag->setSeoTitle($_POST['tag_seo_title'] ?? null);
        $tag->setSeoDescription($_POST['tag_seo_description'] ?? null);
        $tag->setSeoKeywords($_POST['tag_seo_keywords'] ?? null);
        $response = $app->send($tag);
    } catch (\Expando\LocoPackage\Exceptions\AppException $e) {
        die($e->getMessage());
    }

    echo 'Tag Identifier: ' . $response->getIdentifier() . '<br/><br/>';
}
?>

<form method="post">
    <div>
        <label>Connection ID<br/>
            <input type="text" name="connection_id" value="<?php echo htmlspecialchars($_POST['connection_id'] ?? '') ?>"/>
        </label>
    </div>
    <div>
        <label>Identifier<br/>
            <input type="text" name="identifier" value="<?php echo htmlspecialchars($_POST['identifier'] ?? 'j4k2m1n3b4') ?>"/>
        </label>
    </div>
    <div>
        <label>Tag Title<br/>
            <input type="text" name="tag_title" value="<?php echo htmlspecialchars($_POST['tag_title'] ?? 'Velký výprodej') ?>"/>
        </label>
    </div>
    <div>
        <label>Tag Description<br/>
            <input type="text" name="tag_description" value="<?php echo htmlspecialchars($_POST['tag_description'] ?? 'Popis štítku výprodej') ?>"/>
        </label>
    </div>
    <div>
        <label>Tag SEO Title<br/>
            <input type="text" name="tag_seo_title" value="<?php echo htmlspecialchars($_POST['tag_seo_title'] ?? 'Velký výprodej produktů') ?>"/>
        </label>
    </div>
    <div>
        <label>Tag SEO Description<br/>
            <input type="text" name="tag_seo_description" value="<?php echo htmlspecialchars($_POST['tag_seo_description'] ?? 'Výprodej produktů všech značek') ?>"/>
        </label>
    </div>
    <div>
        <label>Tag SEO Keywords<br/>
            <input type="text" name="tag_seo_keywords" value="<?php echo htmlspecialchars($_POST['tag_seo_keywords'] ?? 'vyprodej,sleva,produkty') ?>"/>
        </label>
    </div>
    <div>
        <input type="submit" name="send" value="Send"/>
    </div>
</form>
