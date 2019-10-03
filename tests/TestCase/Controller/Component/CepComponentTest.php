<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\CepComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\CepComponent Test Case
 */
class CepComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\CepComponent
     */
    public $Cep;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Cep = new CepComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cep);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
