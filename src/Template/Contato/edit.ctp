<div class="contato form col-md-10 columns content">
    <?= $this->Form->create($contato) ?>
    <fieldset>
        <legend><?= 'Editar Contato' ?></legend>
        <?php
            echo $this->Form->input('nome');
            echo $this->Form->input('cpf');
            echo $this->Form->input('data_nascimento');
            echo $this->Form->input('telefone', ['maxlength' => 15]);
            echo $this->Form->input('cep');
            echo $this->Form->input('endereco', ['readonly' => true]);
            echo $this->Form->input('numero', ['type' => 'number']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Alterar'), ['id' => 'salvar']) ?>
    <?= $this->Form->end() ?>
</div>

<script type="text/javascript">
$("#telefone").mask("(00) 0000-00009");
$("#cep").mask("99999-999");
$("#cpf").mask("999.999.999-99");

$('#cep').change(function(val) {
    $('#endereco').val('');
    $('#salvar').attr('disabled', true);
    $.ajax({
        type:'get',
        url: path+'contato/getEndereco',                  
        data: {cep: $(this).val()},
        dataType: 'json',
        success:function(result) {

            if (result.erro) {
                alert('CEP Não encontrado.');
            } else {
                var texto = result.logradouro+', '+result.bairro+', '+result.localidade+'-'+result.uf;
                $('#endereco').val(texto);
                $('#salvar').attr('disabled', false);
            }
        }
    });   
});
</script>