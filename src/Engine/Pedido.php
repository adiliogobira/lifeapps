<?php


namespace Lifeapps\Integration\Engine;

use Illuminate\Support\Facades\Session;

/**
 * Class Pedido
 * @package App\Helper\Lifeapps
 */
class Pedido extends LifeAppsConnector
{

    /**
     * @param null $idcliente
     * @param null $idendereco
     * @param null $formadepagamento
     * @return mixed
     */
    public function formaEntrega($idcliente = null, $idendereco = null, $formadepagamento = null, $type = "DELIVERY")
    {
        $this->endPoint = "/v4/app/" . $this->token . $this->tokenSplit . $idcliente . "/formas-entrega/" . $this->tokenFornecedor . "?tipoEntrega={$type}&idendereco={$idendereco}&idformapagamento={$formadepagamento}";
        $this->get();
        return $this->callback;
    }

    /**
     * @param $idcliente
     * @param $pedido
     * @return mixed
     */
    public function pedidoSubmit($idcliente, $pedido)
    {
        $this->endPoint = "/v2/app/" . $this->tokenFornecedor . "/usuario/{$idcliente}/pedido";
        $this->params = $pedido;
        $this->post();
        return $this->callback;
    }

    /**
     * @param $idcliente
     * @return mixed
     */
    public function getPedidos($idcliente)
    {
        $this->endPoint = "/v2/app/pedido/cliente/{$idcliente}";
        $this->get();
        return $this->callback;
    }

    /**
     * @param $idcliente
     * @return mixed
     */
    public function getCupom($idcliente)
    {
        $this->endPoint = "/v2/app/cupom-desconto/cliente/{$idcliente}?onlyLast=false&available=true";
        $this->get();
        return $this->callback;
    }
}
