<?php


namespace Lifeapps\Integration\Engine;


use Illuminate\Support\Facades\Session;

/**
 * Class Cliente
 * @package App\Helper\Lifeapps
 */
class Cliente extends LifeAppsConnector
{

    public function __costruct(){
        $this->endPoint = "/v2/app/";
    }
    /**
     * @param $usuario
     * @return mixed
     */
    public function getClientByLogin($usuario)
    {
        $this->endPoint .= "/v2/app/" . $this->token . "/usuario/{$usuario}";
        $this->get();
        return $this->callback;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function authCliente($data)
    {
        $this->endPoint = "/v1/app/" . $this->token . "/usuario/autenticar";
        $this->params = $data;
        $this->post();
        return $this->callback;
    }

    /**
     * @param null $idcliente
     * @param null $data
     * @return mixed
     */
    public function newCliente($idcliente = null, $data = null)
    {
        $this->endPoint = "/v1/app/" . $this->token . $this->tokenSplit . "{$idcliente}/usuario";
        $this->params = $data;
        $this->post();
        return $this->callback;
    }

    /**
     * @param $idcliente
     * @return mixed
     */
    public function getListCliente($idcliente)
    {
        $this->endPoint = "/v1/app/" . $this->token . $this->tokenSplit . "{$idcliente}/cliente";
        $this->get();
        return $this->callback;
    }

    /**
     * @param $idcliente
     * @return mixed
     */
    public function getEnderecos($idcliente)
    {
        $this->endPoint = "/v1/app/" . $this->token . $this->tokenSplit . "{$idcliente}/enderecos";
        $this->get();
        return $this->callback;
    }

    /**
     * @param $idcliente
     * @param $endereco
     * @return mixed
     */
    public function postEnderecos($idcliente, $endereco)
    {
        $this->endPoint = "/v1/app/" . $this->token . $this->tokenSplit . "{$idcliente}/enderecos";
        $this->params = $endereco;
        $this->post();
        return $this->callback;
    }

    /**
     * @param $idcliente
     * @param $idendereco
     * @param $endereco
     * @param string $action
     * @return mixed
     */
    public function conditionEndereco($idcliente, $idendereco, $endereco, $action = 'excluir')
    {
        $this->endPoint = "/v1/app/" . $this->token . $this->tokenSplit . "{$idcliente}/cliente/enderecos/{$idendereco}/{$action}";
        $this->params = $endereco;
        $this->post();
        return $this->callback;
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        $this->endPoint = "/v1/app/" . $this->token . "/cliente/logout";
        $this->get();
        return $this->callback;
    }

    /**
     * @param $idcliente
     * @return mixed
     */
    public function authRecorver($idcliente)
    {
        $this->endPoint .= $this->token . "/cliente/senha/recuperar/{$idcliente}";
        $this->get();
        return $this->callback;
    }

    /**
     * @param $idcliente
     * @return mixed
     */
    public function configClient($idcliente)
    {
        $this->endPoint .= $this->token . $this->tokenSplit . $idcliente . "/get-configuracoes-cliente";
        $this->get();
        return $this->callback;
    }
}
