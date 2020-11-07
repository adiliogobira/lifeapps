<?php


namespace Lifeapps\Integration\Engine;


use Illuminate\Support\Facades\Session;

/**
 * Class Pagamento
 * @package App\Helper\Lifeapps
 */
class Pagamento extends LifeAppsConnector
{

    /**
     * @param $idcliente
     * @return mixed
     */
    public function formPayment($idcliente = null)
    {
        $cliente = ($idcliente ?? "?idcliente={$idcliente}");
        $this->endPoint .= "/v2/app/" . $this->token . "/fornecedor/" . self::LIFEAPPS_TOKEN_FORNECEDOR . "/formas-pagamento{$cliente}";
        $this->get();
        return $this->callback;
    }

    /**
     * @param $idpedido
     * @param $dados
     * @return mixed
     */
    public function processaPagamento($idpedido, $dados)
    {
        $this->endPoint = "/v4/app/payment/confirm-payment/{$idpedido}";
        $this->params = $dados;
        $this->post();
        return $this->callback;
    }
}
