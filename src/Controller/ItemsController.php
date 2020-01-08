<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;


class ItemsController extends AppController
{
     public function index()
    {
		$itemsTable = $this->Items;
		
	
		 
	}
    
    
    public function add() {

            $itemsTable = TableRegistry::getTableLocator()->get("Items");

            $newItems = $itemsTable->newEntity();


            if ($this->request->is('post')) {

                $newItems = $itemsTable->patchEntity($newItems, $this->request->getData());


                if ($itemsTable->save($newItems)) {
                    $this->Flash->success("Item saved");

                    return $this->redirect(['action' => 'add']);
                }
                else {
                    $this->Flash->error("Item not saved");
                }

            }

            $this->set("item", $newItems);		
        }
}