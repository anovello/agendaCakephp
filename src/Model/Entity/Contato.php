<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contato Entity
 *
 * @property int $id
 * @property string $nome
 * @property string $cpf
 * @property \Cake\I18n\FrozenDate $data_nascimento
 * @property string $telefone
 * @property string $cep
 * @property string $endereco
 * @property string $numero
 * @property \Cake\I18n\FrozenTime $data_inclusao
 * @property \Cake\I18n\FrozenTime|null $data_alteracao
 */
class Contato extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'nome' => true,
        'cpf' => true,
        'data_nascimento' => true,
        'telefone' => true,
        'cep' => true,
        'endereco' => true,
        'numero' => true,
        'data_inclusao' => true,
        'data_alteracao' => true
    ];
}
