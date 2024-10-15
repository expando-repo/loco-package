<?php
use Expando\LocoPackage\Request\CategoryRequest;

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
        $category = new CategoryRequest($_POST['connection_id'] ?? null);
        $category->setCategoryId(intval($_POST['category_id']) ?? null);
        $category->setIdentifier($_POST['identifier'] ?? null);
        $category->setTitle($_POST['category_title']);
        $category->setDescription($_POST['category_description'] ?? null);
        $category->setDescription2($_POST['category_description2'] ?? null);
        $category->setSeoTitle($_POST['category_seo_title'] ?? null);
        $category->setSeoDescription($_POST['category_seo_description'] ?? null);
        $category->setSeoKeywords($_POST['category_seo_keywords'] ?? null);
        $category->setMenuTitle($_POST['category_menu_title'] ?? null);
        $response = $app->send($category);
    } catch (\Expando\LocoPackage\Exceptions\AppException $e) {
        die($e->getMessage());
    }

    echo 'Category ID: ' . $response->getCategoryId() . '<br/><br/>';
}
?>

<form method="post">
    <div>
        <label>Connection ID<br/>
            <input type="text" name="connection_id" value="<?php echo htmlspecialchars($_POST['connection_id'] ?? '') ?>"/>
        </label>
    </div>
    <div>
        <label>Category ID<br/>
            <input type="text" name="category_id" value="<?php echo $_POST['category_id'] ?? null ?>"/>
        </label>
    </div>
    <div>
        <label>Identifier<br/>
            <input type="text" name="identifier" value="<?php echo htmlspecialchars($_POST['identifier'] ?? '') ?>"/>
        </label>
    </div>
    <div>
        <label>Category Title<br/>
            <input type="text" name="category_title" value="<?php echo htmlspecialchars($_POST['category_title'] ?? 'Velká saka') ?>"/>
        </label>
    </div>
    <div>
        <label>Category Description<br/>
            <input type="text" name="category_description" value="<?php echo htmlspecialchars($_POST['category_description'] ?? 'Popis kategorie') ?>"/>
        </label>
    </div>
    <div>
        <label>Category Description2<br/>
            <input type="text" name="category_description" value="<?php echo htmlspecialchars($_POST['category_description2'] ?? 'Popis kategorie 2') ?>"/>
        </label>
    </div>
    <div>
        <label>Category SEO Title<br/>
            <input type="text" name="category_seo_title" value="<?php echo htmlspecialchars($_POST['category_seo_title'] ?? 'Seo nadpis kategorie') ?>"/>
        </label>
    </div>
    <div>
        <label>Category SEO Description<br/>
            <input type="text" name="category_seo_description" value="<?php echo htmlspecialchars($_POST['category_seo_description'] ?? 'Seo popis kategorie') ?>"/>
        </label>
    </div>
    <div>
        <label>Category SEO Keywords<br/>
            <input type="text" name="category_seo_keywords" value="<?php echo htmlspecialchars($_POST['category_seo_keywords'] ?? 'seo,klicova,slova') ?>"/>
        </label>
    </div>
    <div>
        <label>Category Menu Title<br/>
            <input type="text" name="category_menu_title" value="<?php echo htmlspecialchars($_POST['category_menu_title'] ?? 'Menu nadpis') ?>"/>
        </label>
    </div>
    <div>
        <input type="submit" name="send" value="Send"/>
    </div>
</form>
