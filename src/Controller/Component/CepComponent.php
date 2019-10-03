<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Http\Client;

/**
 * Cep component
 */
class CepComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    private $url = 'https://viacep.com.br/ws/';

    public function getEndereco($cep)
    {
    	$this->render = false;
    	$http = new Client();
    	$response = $http->get($this->url.$cep.'/json');

    	return $response->body();
    }
}
