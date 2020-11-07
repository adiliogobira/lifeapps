<?php

namespace Lifeapps\Integration\Engine;

/**
 * Class Banners
 * @package App\Helper\Lifeapps
 */
class Banners extends LifeAppsConnector
{
    /**
     * @return mixed
     */
    public function getCarrouseu()
    {
        $this->endPoint = "/v2/app/" . $this->token . "/customizacao/carrossel/list-for-page/" . self::LIFEAPPS_TOKEN_FORNECEDOR;
        $this->get();
        return $this->callback;
    }

    /**
     * @return mixed
     */
    public function getBanners()
    {
        $this->endPoint = "/v2/app/" . $this->token . "/customizacao/carrossel/list-for-page/" . self::LIFEAPPS_TOKEN_FORNECEDOR;
        $this->get();
        return $this->callback;
    }
}
