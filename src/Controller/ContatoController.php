<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Contato Controller
 *
 * @property \App\Model\Table\ContatoTable $Contato
 *
 * @method \App\Model\Entity\Contato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContatoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $contato = $this->paginate($this->Contato);

        $this->set(compact('contato'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contato = $this->Contato->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $contato = $this->Contato->patchEntity($contato, $data);
            if ($this->Contato->save($contato)) {
                $this->Flash->success(__('Contato salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Falha ao salvar, por favor, verifique os erros.'));
        }
        $this->set(compact('contato'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contato id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contato = $this->Contato->get($id, [
            'contain' => []
        ]);

        if ($contato) {
            $contato->data_nascimento = $contato->data_nascimento->i18nFormat('yyyy-MM-dd');
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contato = $this->Contato->patchEntity($contato, $this->request->getData());

            if ($this->Contato->save($contato)) {
                $this->Flash->success(__('Contato atualizado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro ao atualizar o contato.'));
        }
        $this->set(compact('contato'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contato id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contato = $this->Contato->get($id);
        if ($this->Contato->delete($contato)) {
            $this->Flash->success(__('Contato excluido com sucesso..'));
        } else {
            $this->Flash->error(__('Falha ao tentar excluir o contato, por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getEndereco()
    {
        $this->render(false);
        $this->loadComponent('Cep');

        $ret = $this->Cep->getEndereco($this->request->getQuery('cep'));
        echo $ret;
    }
}
