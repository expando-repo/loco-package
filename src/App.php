<?php

declare(strict_types=1);

namespace Expando\LocoPackage;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\Request\ProductRequest;
use Expando\LocoPackage\Response\Connection;
use Expando\LocoPackage\Response\Product;
use JetBrains\PhpStorm\ArrayShape;

class App
{
    private array $token = [];
    private ?string $access_token = null;
    private ?string $refresh_token = null;
    private ?int $expires = null;
    private string $url = 'https://loco-app.expan.do';

    /**
     * @return bool
     */
    public function isLogged(): bool
    {
        if (!$this->access_token) {
            return false;
        }
        return true;
    }


    /**
     * @param ?array $token
     */
    public function setToken(?array $token): void
    {
        if ($token !== null) {
            $this->access_token = $token['access_token'] ?? null;
            $this->refresh_token = $token['refresh_token'] ?? null;
            $this->expires = $token['expires'] ?? null;
            $this->token = $token;
        }
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['access_token' => "null|string", 'refresh_token' => "null|string", 'expires' => "int|null", 'token' => "array"])]
    public function getToken(): array
    {
        return [
            'access_token' => $this->access_token,
            'refresh_token' => $this->refresh_token,
            'expires' => $this->expires,
            'token' => $this->token,
        ];
    }

    /**
     * @return bool
     */
    public function isTokenExpired(): bool
    {
        if (!$this->expires) {
            return false;
        }
        return $this->isLogged() && $this->expires < time();
    }

    /**
     * @param int $clientId
     * @param string $clientSecret
     * @return array|null
     */
    public function refreshToken(int $clientId, string $clientSecret): ?array
    {
        $post = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->refresh_token,
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'scope' => '',
        ];

        $headers = [
            'Accepts-version: 1.0',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url . '/oauth/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $result = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($result, true);
        if ($data === false || ($data['error'] ?? null)) {
            $this->access_token = null;
            $this->refresh_token = null;
            $this->expires = null;
            $this->token = [];
            return null;
        }
        $this->setToken([
            'access_token' => $data['access_token'],
            'refresh_token' => $data['refresh_token'],
            'expires' => time() + $data['expires_in'],
        ]);
        return $data;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @param IRequest $request
     * @return IResponse
     * @throws AppException
     */
    public function send(IRequest $request): IResponse
    {
        if (!$this->isLogged()) {
            throw new AppException('App is not logged');
        }

        if ($request instanceof ProductRequest) {

            if ($request->getProductId()) {
                $data = $this->sendToApp('/products/' . $request->getConnectionId() . '/' . $request->getProductId() . '/', 'PUT', $request->asArray());
                $result = new Product\PostResponse($data);
            } else {
                $data = $this->sendToApp('/products/' . $request->getConnectionId() . '/', 'POST', $request->asArray());
                $result = new Product\PostResponse($data);
            }
        }
        else {
            throw new AppException('Request not defined');
        }

        return $result;
    }


    /**
     * @return Connection\ListResponse
     * @throws AppException
     */
    public function listConnections(): Connection\ListResponse
    {
        if (!$this->isLogged()) {
            throw new AppException('App is not logged');
        }

        $data = $this->sendToApp('/connections/', 'GET');
        return new Connection\ListResponse($data);
    }

    /**
     * @param int $connectionId
     * @param int $page
     * @param int $onPage
     * @return Product\ListResponse
     * @throws AppException
     */
    public function listProducts(int $connectionId, int $page = 1, int $onPage = 20): Product\ListResponse
    {
        if (!$this->isLogged()) {
            throw new AppException('App is not logged');
        }

        $data = $this->sendToApp('/products/' . $connectionId . '/', 'GET', array_filter([
            'page' => $page,
            'on_page' => $onPage,
        ]));
        return new Product\ListResponse($data);
    }

    /**
     * @param int $connectionId
     * @return Product\ListResponse
     * @throws AppException
     */
    public function productChanges(int $connectionId): Product\ListResponse
    {
        if (!$this->isLogged()) {
            throw new AppException('App is not logged');
        }

        $data = $this->sendToApp('/products/changes/' . $connectionId . '/', 'GET');
        return new Product\ListResponse($data);
    }

    /**
     * @param int $connectionId
     * @param int $productId
     * @return Product\GetResponse
     * @throws AppException
     */
    public function getProduct(int $connectionId, int $productId): Product\GetResponse
    {
        if (!$this->isLogged()) {
            throw new AppException('App is not logged');
        }

        $data = $this->sendToApp('/products/' . $connectionId . '/' . $productId . '/', 'GET');
        return new Product\GetResponse($data);
    }

    /**
     * @param Product\GetResponse $product
     * @return bool
     * @throws AppException
     */
    public function commitProduct(Product\GetResponse $product): bool
    {
        if (!$product->getChangeId()) {
            return false;
        }

        return $this->commitProductRequest($product->getChangeId());
    }

    /**
     * @param int $changeId
     * @return bool
     * @throws AppException
     */
    public function commitProductRequest(int $changeId): bool
    {
        if (!$this->isLogged()) {
            throw new AppException('App is not logged');
        }

        $data = $this->sendToApp('/products/commit/' . $changeId . '/', 'PUT');
        return $data['status'] === 'success';
    }

    /**
     * @param int $productId
     * @return bool
     * @throws AppException
     */
    public function deleteProduct(int $productId): bool
    {
        if (!$this->isLogged()) {
            throw new AppException('App is not logged');
        }

        $data = $this->sendToApp('/products/delete/' . $productId . '/', 'DELETE');
        return $data['status'] === 'success';
    }

    /**
     * @param ?string $icu
     * @param array<int> $productIds
     * @return bool
     * @throws AppException
     */
    public function deleteTranslation(array $productIds, ?string $icu = null): bool
    {
        if (!$this->isLogged()) {
            throw new AppException('App is not logged');
        }

        $data = $this->sendToApp('/translations/delete/' . $icu, 'DELETE', ['product_id' => $productIds]);
        return $data['status'] === 'success';
    }

    /**
     * @param string $action
     * @param $method
     * @param array $body
     * @return array
     * @throws AppException
     */
    public function sendToApp(string $action, $method, array $body = []): array
    {
        $headers = array(
            'Accepts-version: 1.0',
            'Authorization: Bearer ' . $this->access_token,
        );

        $url = $this->url . '/api' . $action;
        if (!empty($body) && $method === 'GET') {
            $url .= '?' . http_build_query($body);
        }
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (!empty($body) && in_array($method, ['POST', 'PUT', 'DELETE'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
        }
        $return = curl_exec($ch);
        curl_close($ch);

        if (!$return) {
            throw new AppException('Translator did not return a correct response');
        }
        if ($_GET['debug'] ?? null) {
            echo '<pre>';
            print_r($return);
        }
        $data = (array) json_decode($return, true);

        if (!$data || ($data['status'] ?? null) === null) {
            $message = ($data['message'] ?? null);
            throw new AppException('Response data is bad' . ($message ? ' ('.$message.')' : ''));
        }

        if ($data['status'] === 'error') {
            throw new AppException('Response error: ' . ($data['message'] ?? null));
        }
        return $data;
    }
}
