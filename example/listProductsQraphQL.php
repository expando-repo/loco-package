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

        function getProducts($app): array
        {
            $result = [];
            $cursor = null;
            while(true) {
                $query = <<<'GRAPHQL'
                    query productQuery($connectionIdExport: Int!, $cursor: String) {
                      products(connectionIdExport: $connectionIdExport, after: $cursor, first: 10) {
                        edges {
                          node {
                            identifier
                            translations {
                              language
                              title
                            }
                            variants {
                              price
                              options {
                                identifier
                                values {
                                  identifier
                                  translations {
                                    language
                                    name
                                  }
                                }
                                translations {
                                  language
                                  name
                                }
                              }
                            }
                          }
                        }
                        pageInfo {
                          hasNextPage
                          endCursor
                        }
                      }
                    }
                GRAPHQL;

                $payload = [
                    'query' => $query,
                    'variables' => [
                        'connectionIdExport' => (int) $_POST['connection_id'],
                        'cursor' => $cursor,
                    ]
                ];

                try {
                    $response = $app->graphQL($payload);
                } catch (\Expando\LocoPackage\Exceptions\AppException $e) {
                    die($e->getMessage());
                }

                $result = array_merge($result, $response['data']['products']['edges']);

                $cursor = $response['data']['products']['pageInfo']['endCursor'] ?? null;
                if (!($response['data']['products']['pageInfo']['hasNextPage'] ?? false)) {
                    break;
                }
            }

            return $result;
        }

        echo '<ul>';
        foreach (getProducts($app) as $product) {
            echo '<li><strong>Product ID:</strong> ' . $product['node']['identifier'] . ', <strong>Count variants:</strong> ' . count($product['node']['variants']) . '</li>';
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
        <input type="submit" name="send" value="send" />
    </div>
</form>
