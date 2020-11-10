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
        $this->endPoint = "/v2/app/" . $this->token . "/customizacao/carrossel/list-for-page/" . $this->tokenFornecedor. "?page=page:home%20%20%20%20&device=desktop&idformapagamento=f430d089-93e0-4d2a-bd4b-f7ddca530a7b";
        $this->get();
        return $this->callback;
    }

    /**
     * @return mixed
     */
    public function getBanners()
    {
        $this->endPoint = "/v2/app/" . $this->token . "/customizacao/carrossel/list-for-page/" . $this->tokenFornecedor. "?page=page:home%20%20%20%20&device=desktop&idformapagamento=f430d089-93e0-4d2a-bd4b-f7ddca530a7b";
        $this->get();
        return $this->callback;
    }
}
