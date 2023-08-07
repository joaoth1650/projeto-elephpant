<?php

declare(strict_types=1);

namespace App\UseCases\Domains\SKU;

use App\Interfaces\ResultUseCaseInterface;
use App\Models\Sku;
use App\UseCases\UseCaseAbstract;
use App\Utils\HelpersUtils;
use App\Utils\ResultUtils;

class SaveSkuPrecificacaoUseCase extends UseCaseAbstract
{
    public function __construct(
        private readonly int $loja_id,
        private array $skus
    ){}

    private array $skus_ignoreds = [];

    private function structure(): array{
        return [
            "SKU" => 0,
            "CUSTO_DE_VENDA" => 1,
            "QTD" => 2,
            "CUSTO_DO_PRODUTO" => 3,
            "IMPOSTO" => 4,
            "DESPESA_FIXA" => 5,
            "DESPESA_OPERACIONAL" => 6,
            "MARGEM_LUCRO" => 7,
        ];
    }

    private function defaultResult(array $success = [], array $ignoreds = [], array $faileds = []):array{
        return [
            "success" => $success,
            "ignoreds" => $ignoreds,
            "faileds" => $faileds 
        ];
    }

    public function execute(): ResultUseCaseInterface {
        // remover a primeira linha, já que é só cabeçalho
        $skus = $this->skus;
        if(count($skus) <= 1 ){
            return new ResultUtils( $this->defaultResult([], [], [
                "code" => "SSPUC53",
                "msg" => "Nenhum SKU para ser processado! Por favor informe os SKUs conforme a planilha de modelo.", 
                "skus"=> []
            ]), false );
        }
        unset($skus[0]);
        $skus = array_values( array_filter($skus, fn($s) => (!empty($s) && !empty($s[0]))) );
        $struct = $this->structure();
        
        $skus = collect($skus)->map(fn($s) => [...$s, $struct['SKU'] => strtoupper( $s[ $struct['SKU'] ] ?? "" ) ]);
        $skus_nome = $skus->pluck($struct['SKU'])->toArray();
        $skus_db = Sku::query()
        ->where('loja_id', $this->loja_id)
        ->whereIn('nome', $skus_nome)
        ->get(['id' , 'nome']);

        if($skus_db->count()){
            /** 
             * Foi encontrado SKUS iguais aos informados, e serão ignorados.
             * No momento não realizar update de SKUS.
             * @todo falta criar solução para atualizar SKUS por planilha e que isso recalcule tbm os preços de marketplace.
             */
            $this->skus_ignoreds[] = [
                "code" => "SSPUC78",
                "msg" => "SKU(s) já existe(m) e por enquanto não pode(m) ser atualizado.", 
                "skus"=> $skus_db->pluck('nome')->toArray()
            ];

            $skus = $skus->whereNotIn($struct['SKU'], $skus_db->pluck('nome')->toArray());
            if($skus->isEmpty()){
                return new ResultUtils( $this->defaultResult([], $this->skus_ignoreds , []), false );
            }
        }
        unset($skus_db);

        $inserts = [];
        $nomes = [];
        foreach($skus as $sku) {
            $nomes[] = $sku[ $struct['SKU'] ];
            $inserts[] = [
                'id' => HelpersUtils::newUlid(),
                'nome' => strtoupper( $sku [$struct['SKU']] ),
                'loja_id' => $this->loja_id,
                'quantidade_produto' => (int) ($sku[$struct['QTD']] ?? 1),
                'custo_produto' => (float)  ($sku[$struct['CUSTO_DO_PRODUTO']] ?? 0),
                'imposto' => (float)  ($sku[$struct['IMPOSTO']] ?? 0),
                'despesas_fixas' => (float)  ($sku[$struct['DESPESA_FIXA']] ?? 0),
                'despesas_operacionais' => (float)  ($sku[$struct['DESPESA_OPERACIONAL']] ?? 0),
                'margem_lucro' => (float)  ($sku[$struct['MARGEM_LUCRO']] ?? 0)
            ];
        }
        try {
            $result = Sku::query()->insert($inserts);