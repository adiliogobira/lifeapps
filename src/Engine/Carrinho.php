<?php


namespace Lifeapps\Integration\Engine;

use App\Setting;
use Illuminate\Support\Facades\Session;

/**
 * Class Carrinho
 * @package App\Helper\Lifeapps
 */
class Carrinho extends LifeAppsConnector
{

    /**
     * @return mixed
     */
    public function getCarrinho($formadepagamento)
    {
        $idcliente = (Session::has("idcliente") ? Session::get('idcliente') : null);
        $this->endPoint = "/v2/app/" . $this->token . "" . $this->tokenSplit . "{$idcliente}/usuario/{$idcliente}/cart?idformapagamento={$formadepagamento}&idfornecedor=" . $this->tokenFornecedor . "&idtipoassinatura=";
        $this->get();
        return $this->callback;
    }

    /**
     * @param $json
     * @param $idcliente
     * @return mixed
     */
    public function adicionar($json, $idcliente, $formadepagamento)
    {
        $this->endPoint = "/v2/app/" . $this->token . "" . $this->tokenSplit . "{$idcliente}/usuario/{$idcliente}/cart?idfornecedor=" . $this->tokenFornecedor . "&idformapagamento={$formadepagamento}&modoRepeticaoPedido=false&idtipoassinatura=";
        $this->params = $json;
        $this->post();
        return $this->callback;
    }

    public function updateSession()
    {
        $items = [];
        $cart = Session::get("cart");

        if (!empty($cart)) {
            $ProdutoLife = new Produto();
            foreach ($cart['items'] as $keys => $item) {

                $produtos = $ProdutoLife->pesquisarProduto($keys)->dados[0];

                $items = [
                    "id" => $produtos->id,
                    "idproduto" => $produtos->idproduto,
                    "id_produto_erp" => $produtos->id_produto_erp,
                    "idcadastroextraproduto" => $produtos->idcadastroextraproduto,
                    "preconf" => $produtos->preconf,
                    "preco" => $produtos->preco,
                    "preco_original" => $produtos->preco_original,
                    "precovendaatacado" => $produtos->precovendaatacado,
                    "nome" => "{$produtos->nome}",
                    "nomeunitario" => "{$produtos->nomeunitario}",
                    "unidade" => "{$produtos->unidade}",
                    "unidadecadastral" => "{$produtos->unidadecadastral}",
                    "maxporpedido" => $produtos->maxporpedido,
                    "minvendaatacado" => $produtos->minvendaatacado,
                    "mensagemcardproduto" => "{$produtos->mensagemcardproduto}",
                    "quantidade" => $item['amount'],
                    "labelunidade" => "{$produtos->labelunidade}",
                    "labelunidademultiplo" => "{$produtos->labelunidademultiplo}",
                    "multiploincremento" => $produtos->multiploincremento,
                    "tipo_produto" => "{$produtos->tipo_produto}",
                    "esconder_preco_sub_itens" => $produtos->esconder_preco_sub_itens,
                    "granularidade" => $produtos->granularidade,
                    "politicas" => $produtos->politicas,
                    "slug" => "{$produtos->slug}",
                    "efeitospoliticas" => $produtos->efeitospoliticas,
                    "preco_sem_politica_varejo" => $produtos->preco_sem_politica_varejo,
                    "preco_sem_politica_atacado" => $produtos->preco_sem_politica_atacado,
                    "meta_info" => $produtos->meta_info,
                    "metatags_seo" => $produtos->metatags_seo,
                    "tags_pesquisa" => (!empty($produtos->tags_pesquisa) ? $produtos->tags_pesquisa : null),
                    "caracteristicas" => $produtos->caracteristicas,
                    "usaAtacado" => (!empty($produtos->usaAtacado) ? $produtos->usaAtacado : null),
                    "precoDestaque" => (!empty($produtos->precoDestaque) ? $produtos->precoDestaque : null),
                    "precoAuxiliar" => (!empty($produtos->precoAuxiliar) ? $produtos->precoAuxiliar : null),
                    "msgDestaque" => "",
                    "msgMaxporpedido" => ""
                ];
                $newQtd['cartItens'][] = $items;
            }
            $json = ($newQtd);

            $novoCarrinho = $this->adicionar($json, Session::get('idcliente'));
            //var_dump($novoCarrinho);
            return $novoCarrinho;
        } else {
            //carrinho vazio... montar retorno de mensagem com popup modal!
            return false;
        }
    }

    public function cupomDesconto($codigo, $idcliente)
    {
        $this->endPoint = "/v2/app/cupom-desconto/validar-desconto/fornecedor/" . $this->tokenFornecedor . "/cliente/{$idcliente}/cupom/{$codigo}";
        $this->get();
        return $this->callback;
    }
}
