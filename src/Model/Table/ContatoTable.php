<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contato Model
 *
 * @method \App\Model\Entity\Contato get($primaryKey, $options = [])
 * @method \App\Model\Entity\Contato newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Contato[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Contato|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contato saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contato patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Contato[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Contato findOrCreate($search, callable $callback = null, $options = [])
 */
class ContatoTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('contato');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 100, 'O Nome é obrigatório.')
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('cpf')
            ->maxLength('cpf', 14, 'Digite o CPF completo.')
            ->requirePresence('cpf', 'create')
            ->notEmptyString('cpf')
            ->add('cpf', 'custom', [
                'rule' => function ($value, $context) {
                    // Verifica se um número foi informado
                    if(empty($value)) {
                        return false;
                    }

                    // Elimina possivel mascara
                    $cpf = str_replace(['.', '-'], '', $value);
                    
                    // Verifica se o numero de digitos informados é igual a 11 
                    if (strlen($cpf) != 11) {
                        return false;
                    }
                    // Verifica se nenhuma das sequências invalidas abaixo 
                    // foi digitada. Caso afirmativo, retorna falso
                    else if ($cpf == '00000000000' || 
                        $cpf == '11111111111' || 
                        $cpf == '22222222222' || 
                        $cpf == '33333333333' || 
                        $cpf == '44444444444' || 
                        $cpf == '55555555555' || 
                        $cpf == '66666666666' || 
                        $cpf == '77777777777' || 
                        $cpf == '88888888888' || 
                        $cpf == '99999999999') {
                        return false;
                     // Calcula os digitos verificadores para verificar se o
                     // CPF é válido
                     } else {   
                        
                        for ($t = 9; $t < 11; $t++) {
                            
                            for ($d = 0, $c = 0; $c < $t; $c++) {
                                $d += $cpf{$c} * (($t + 1) - $c);
                            }
                            $d = ((10 * $d) % 11) % 10;
                            if ($cpf{$c} != $d) {
                                return false;
                            }
                        }

                        return true;
                    }
                },
                'message' => 'CPF inválido.'
            ])
            ->add('cpf', 'unique', [
                'rule' => function($value, $context) {
                    $data = $context['data'];

                    if (!empty($data['id'])) {
                        $ret = $this->find()->where(['cpf' => $value, 'id !=' => $data['id']])->first();
                    } else {
                        $ret = $this->find()->where(['cpf' => $value])->first();
                    }

                    if (!$ret) {
                        return true;
                    } 
                    return false;
                },
                'message' => 'CPF já cadastrado, utilize o editar.'
            ]);

        $validator
            ->date('data_nascimento')
            ->requirePresence('data_nascimento', 'create', 'Data de nascimento é obrigatório.')
            ->notEmptyDate('data_nascimento')
            ->add('data_nascimento', 'custom', [
                'rule' => function ($value, $context) {
                    $anos = date('Y') - date('Y', strtotime($value));

                    if ($anos > 0 && $anos <= 100) {
                        return true;
                    }
                    return false;
                },
                'message' => 'A idade deve ser maior que 0 e menor que 100.'
            ]);

        $validator
            ->scalar('telefone')
            ->maxLength('telefone', 15)
            ->requirePresence('telefone', 'create')
            ->notEmptyString('telefone')
            ->add('telefone', 'custom', [
                'rule' => function ($value, $context) {
                    $telefone = trim(str_replace('/', '', str_replace(' ', '', str_replace('-', '', str_replace(')', '', str_replace('(', '', $value))))));

                    $regexTelefone = "/\(?\d{2}\)?\s?\d{5}\-?\d{4}/";

                    if (preg_match($regexTelefone, $telefone )) {
                        return true;
                    }else{
                        return false;
                    }
                },
                'message' => 'Número de telefone inválido.'
            ]);


        $validator
            ->scalar('cep')
            ->maxLength('cep', 9, 'Campo cep inválido.')
            ->minLength('cep', 9, 'Campo cep inválido.')
            ->requirePresence('cep', 'create', 'O campo CEP é obrigatório.')
            ->notEmptyString('cep');

        $validator
            ->scalar('endereco')
            ->maxLength('endereco', 255)
            ->requirePresence('endereco', 'create')
            ->notEmptyString('endereco');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 50)
            ->requirePresence('numero', 'create')
            ->notEmptyString('numero');

        $validator
            ->dateTime('data_inclusao')
            ->notEmptyDateTime('data_inclusao');

        $validator
            ->dateTime('data_alteracao')
            ->allowEmptyDateTime('data_alteracao');

        return $validator;
    }
}
