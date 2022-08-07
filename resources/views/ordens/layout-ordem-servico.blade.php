
<table border='2' style='width:100%;'>
    <tbody>
        <tr>
            <td rowspan='4' class='align-center'>
                <img src='/dist/img/logo_multilimp.jpg' width='120' />
            </td>
            <td rowspan='2' class='align-center'>Telefones</td>
            <td rowspan='3' colspan='2' class='align-center'>
                ORDEM DE SERVIÇO
            </td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td class='align-center'>14 98118-5969</td>
        </tr>
        <tr>
            <td class='align-center'>-</td>
            <td class='align-right'>Nº</td>
            <td class='align-center'>{{$ordemServico->OrdemServicoId}}</td>
        </tr>
        <tr>
            <td colspan='4'>
                <table style='width: 100%;'>
                    <tr>
                        <td colspan='2'>Multilimp Serviços de Limpeza LTDA.</td>
                        <td class='align-right'>CNPJ:</td>
                        <td>11111111/1111-11</td>
                        <td class='align-right'>Data Agendamento</td>
                        <td>{{$ordemServico->ValorTotal}}</td>
                    </tr>
                    <tr>
                        <td colspan='6'>R. Albertina Arrielo, 426, B. Silas</td>
                    </tr>
                    <tr>
                        <td colspan='2'>Jaú/SP</td>
                        <td class='align-right'>CEP:</td>
                        <td>32071-128</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan='4'>
                <table style='width: 100%;' border='2'>
                    <tr>
                        <td>Cliente:</td>
                        <td colspan='2'>{{$cliente->nome}}</td>
                        <td class='align-right'>CNPJ:</td>
                        <td>{{$cliente->cpfcnpj}}</td>
                    </tr>
                    <tr>
                        <td>Endereço:</td>
                        <td colspan='4'>{{$ordemServico->Endereco}}</td>
                    </tr>
                    <tr>
                        <td>Bairro:</td>
                        <td colspan='2'>{{$ordemServico->Bairro}}</td>
                        <td class='align-right'>Fone:</td>
                        <td>{{$ordemServico->Telefone}}</td>
                    </tr>
                    <tr>
                        <td>Cidade:</td>
                        <td colspan='2'>{{$ordemServico->Cidade}}</td>
                        <td class='align-right'>UF:</td>
                        <td>{{$ordemServico->UF}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan='4' style='height: 100px' class='valign-top'>
                Descrição do serviço: {{$ordemServico->Descricao}}
            </td>
        </tr>
        <tr>
            <td colspan='4' style='height: 100px;' class='valign-top'>
                Observaçoes: {{$ordemServico->Observacoes}}
            </td>
        </tr>
        <tr>
            <td colspan='4'>
                <table style='width: 100%;' border='1'>
                    <tr>
                        <td rowspan='3' class='valign-bottom' style='width: 70%;'>
                            Atendente: <br/>
                        </td>
                        <td class='align-right'>Orçamento:</td>
                        <td class='align-center'>{{$ordemServico->Valor}}</td>
                    </tr>
                    <tr>
                        <td class='align-right'>Desconto:</td>
                        <td class='align-center'>{{$ordemServico->Desconto}}</td>
                    </tr>
                    <tr>
                        <td class='align-right'>TOTAL:</td>
                        <td class='align-center'>{{$ordemServico->ValorTotal}}</td>
                    </tr>
                    <tr>
                        <td colspan='2' class='align-right'>Data da Execução:</td>
                        <td class='align-center'>{{$ordemServico->DataExecucao}}</td>
                    </tr>
                    <tr>
                        <td colspan='2' class='align-right'>Vencimento da garantia:</td>
                        <td class='align-center'>{{$ordemServico->DataExecucao}}</td>
                    </tr>
                    <tr>
                        <td colspan='2' class='align-right'>Situação Garantia:</td>
                        <td class='align-center'>0 dias para vencer.</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
