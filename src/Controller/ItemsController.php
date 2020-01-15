<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;


class ItemsController extends AppController
{
     public function view()
    {
		$itemsTable = TableRegistry::getTableLocator()->get('Items');
		$itemsTable = $this->Items;
		
		$query = $itemsTable->find();
		
		$allItems = $query->toArray();
		
		$this->set("items", $allItems);
         
    }
    
    public function index() {
            

            $itemsTable = TableRegistry::getTableLocator()->get("Items");

            $newItems = $itemsTable->newEntity();
            if ($this->request->is('post')) {

                $newItems = $itemsTable->patchEntity($newItems, $this->request->getData());


                if ($itemsTable->save($newItems)) {
                    $this->Flash->success("Item saved");

                    return $this->redirect(['action' => 'index']);
                }
                else {
                    $this->Flash->error("Item not saved");
                }

            }

            $this->set("item", $newItems);	
        
        $itemsTable = $this->Items;
		
		$query = $itemsTable->find();
		
		$allItems = $query->toArray();
		
		$this->set("items", $allItems);
    
        }
        public function add() {
            if ($this->request->is('post')) {
            
            $itemsTable = TableRegistry::get("Items");
            $items = $itemsTableTable->newEntity($this->request->getData());
            $items->user_id = $this->Auth->user('id');
            $post->slug = time().Inflector::slug($post->post_content);
            
                var_dump($items);
            if(!empty($this->request->getData('uploadedPhoto')['name'])){
                $imgFileType = strtolower(pathinfo($this->request->getData('uploadedPhoto')['name'], PATHINFO_EXTENSION));
                
                if($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg" && $imgFileType != "gif" ) {
                    $this->Flash->error("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                    Log::warning("File has wrong extension. Upload tried by ".$this->Auth->user('first_name')." ".$this->Auth->user('last_name').", IP address:".$this->request->clientIp(), ['scope' => ['posts']]);
                    return $this->redirect(['action' => 'index']);
                }else{
                    $target_filePath = 'UploadedPhotos/'.time().$this->request->getData('uploadedPhoto')['name'];

                    if(move_uploaded_file($this->request->getData('uploadedPhoto')['tmp_name'], WWW_ROOT.$target_filePath)){
                        $items->Item_Image = $target_filePath;
                    }else{
                        $this->Flash->error("Your file was not uploaded.");
                        Log::warning("File was not uploaded. Upload tried by ".$this->Auth->user('first_name')." ".$this->Auth->user('last_name').", IP address:".$this->request->clientIp(), ['scope' => ['items']]);
                    }
                }
            }
            }
  
}
}