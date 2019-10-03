<div class="contato view col-lg-10 col-md-9">
    <h3><?= h($contato->id) ?></h3>
    <table class="table table-striped table-hover">
        <tr>
            <th>Nome</th>
            <td><?= h($contato->nome) ?></td>
        </tr>
        <tr>
            <th>Cpf</th>
            <td><?= h($contato->cpf) ?></td>
        </tr>
        <tr>
            <th>Telefone</th>
            <td><?= h($contato->telefone) ?></td>
        </tr>
        <tr>
            <th>Cep</th>
            <td><?= h($contato->cep) ?></td>
        </tr>
        <tr>
            <th>Endereco</th>
            <td><?= h($contato->endereco) ?></td>
        </tr>
        <tr>
            <th>Numero</th>
            <td><?= h($contato->numero) ?></td>
        </tr>
        <tr>
            <th>'Id</th>
            <td><?= $this->Number->format($contato->id) ?></td>
        </tr>
        <tr>
            <th>Data Nascimento</th>
            <td><?= h($contato->data_nascimento) ?></tr>
        </tr>
        <tr>
            <th>Data Inclusao</th>
            <td><?= h($contato->data_inclusao) ?></tr>
        </tr>
        <tr>
            <th>Data Alteracao</th>
            <td><?= h($contato->data_alteracao) ?></tr>
        </tr>
    </table>
</div>
