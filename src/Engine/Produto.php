<?php


namespace Lifeapps\Integration\Engine;


/**
 * Class Produto
 * @package App\Helper\Lifeapps
 */
class Produto extends LifeAppsConnector
{
    /**
     * @param $idproduto
     * @return mixed
     */
    public function getSingleProduct($idproduto)
    {
        $this->endPoint = "/v2/app/" . self::LIFEAPPS_TOKEN_FORNECEDOR . "/fornecedor/" . self::LIFEAPPS_TOKEN_FORNECEDOR . "/produto/{$idproduto}";
        $this->get();
        return $this->callback;
    }

    /**
     * @return mixed
     */
    public function getMixProduct()
    {
        $idcliente = (session()->has('idcliente') ? session()->get("idcliente") : null);
        $this->endPoint = "/v1/app/" . $this->token . self::LIFEAPPS_TOKEN_SPLIT . $idcliente . "/listaprodutosf/" . self::LIFEAPPS_TOKEN_FORNECEDOR . "?sk=&page=0&formapagamento=f430d089-93e0-4d2a-bd4b-f7ddca530a7b&ordenacao=Relev%C3%A2ncia%20na%20pesquisaZ&canalVenda=WEB&tagsPesquisa=";

        $this->get();
        return $this->callback;
    }

    /**
     * @param string $category
     * @param string $order
     * @return mixed
     */
    public function getMixProductByCat(string $category, $order = "Relev%C3%A2ncia+na+pesquisa", $page = 0)
    {
        $idcliente = (session()->has('idcliente') ? session()->get("idcliente") : null);
        $this->endPoint = "/v1/app/" . $this->token . self::LIFEAPPS_TOKEN_SPLIT . $idcliente . "/listaprodutosf/" . self::LIFEAPPS_TOKEN_FORNECEDOR . "?categ={$category}&sk=&page={$page}&formapagamento=f430d089-93e0-4d2a-bd4b-f7ddca530a7b&ordenacao={$order}&canalVenda=WEB&tagsPesquisa=";

        $this->get();
        return $this->callback;
    }

    /**
     * @param string $search
     * @param int $page
     * @param string $order
     * @return mixed
     */
    public function pesquisarProduto(string $search, int $page = 0, $order = "Relev%C3%A2ncia+na+pesquisa")
    {
        $search = urlencode($search);
        $idcliente = (session()->has('idcliente') ? session()->get("idcliente") : null);
        $this->endPoint = "/v1/app/" . $this->token . self::LIFEAPPS_TOKEN_SPLIT . $idcliente . "/listaprodutosf/" . self::LIFEAPPS_TOKEN_FORNECEDOR . "?sk={$search}&page={$page}&offset=100&formapagamento=f430d089-93e0-4d2a-bd4b-f7ddca530a7b&ordenacao={$order}&canalVenda=WEB&tagsPesquisa=";

        $this->get();
        return $this->callback;
    }
}
