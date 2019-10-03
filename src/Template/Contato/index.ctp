<div class="contato index col-md-10 columns content">
    <h3>Contato</h3>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('nome') ?></th>
                <th><?= $this->Paginator->sort('cpf') ?></th>
                <th><?= $this->Paginator->sort('data_nascimento') ?></th>
                <th><?= $this->Paginator->sort('telefone') ?></th>
                <th><?= $this->Paginator->sort('cep') ?></th>
                <th><?= $this->Paginator->sort('endereco') ?></th>
                <th><?= $this->Paginator->sort('numero') ?></th>
                <th class="actions"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contato as $contato): ?>
            <tr>
                <td><?= $this->Number->format($contato->id) ?></td>
                <td><?= h($contato->nome) ?></td>
                <td><?= h($contato->cpf) ?></td>
                <td><?= h($contato->data_nascimento) ?></td>
                <td><?= h($contato->telefone) ?></td>
                <td><?= h($contato->cep) ?></td>
                <td><?= h($contato->endereco) ?></td>
                <td><?= h($contato->numero) ?></td>
                <td class="actions" style="white-space:nowrap">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contato->id], ['class'=>'btn btn-primary btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contato->id], ['confirm' => __('Você deseja realmente excluir esse contato # {0}?', $contato->id), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <center>
            <ul class="pagination">
                <?= $this->Paginator->prev('&laquo; ' . __('anterior'), ['escape'=>false]) ?>
                <?= $this->Paginator->numbers(['escape'=>false]) ?>
                <?= $this->Paginator->next(__('próximo') . ' &raquo;', ['escape'=>false]) ?>
            </ul>
            <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}')) ?></p>
        </div>
    </center>
</div>
</div>