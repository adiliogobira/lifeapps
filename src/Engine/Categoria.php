<?php


namespace Lifeapps\Integration\Engine;


/**
 * Class Categoria
 * @package App\Helper\Lifeapps
 */
class Categoria extends LifeAppsConnector
{

    /**
     * @return $this
     */
    public function getCategorias()
    {
        $this->endPoint = "/v2/app/sometoken/listacategoriasprodutos/" . self::LIFEAPPS_TOKEN_FORNECEDOR . "?idsegmento=" . self::LIFEAPPS_SEGMENT . "&device=desktop";
        return $this;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getDadosCategoria($slug)
    {
        $this->endPoint = "/v2/app/setores-produto/obter-setor/" . self::LIFEAPPS_TOKEN_FORNECEDOR . "/{$slug}";
        $this->get();
        return $this->callback;
    }

    /**
     * @return mixed
     */
    public function getDepartamento()
    {
        $this->endPoint = "/v2/app/sometoken/listacategoriasprodutos/" . self::LIFEAPPS_TOKEN_FORNECEDOR . "?idsegmento=" . self::LIFEAPPS_SEGMENT . "&device=desktop";
        $this->get();
        return $this->callback;
    }

    /**
     * @param $categoria
     * @return |null
     */
    public function getIdCategoriaBySlug($categoria)
    {
        $idCategoria = null;
        $this->getCategorias()->render();
        $categorias = json_decode($this->getResult());
        foreach ($categorias->setores as $cat) {
            if ($cat->slug == $categoria) {
                $idCategoria = $cat->id;
            }
        }
        return $idCategoria;
    }

    /**
     * @param $categoria
     * @return array|null
     */
    public function getTituloCategoriaSlug($categoria)
    {
        $idCategoria = null;
        $this->getCategorias()->render();
        $categorias = json_decode($this->getResult());
        //        var_dump($categorias);
        foreach ($categorias->setores as $cats) {
            //            var_dump($cats);
            foreach ($cats->subitens as $cat) {
                //                var_dump($cat);
                if ($cat->slug === $categoria) {
                    //                    echo "achei-me {$cat->titulo}";
                    $idCategoria = [
                        'id' => $cat->id,
                        'titulo' => $cat->titulo
                    ];
                    //                    $idCategoria = $cat->titulo;
                }
            }
        }
        return $idCategoria;
    }
}
