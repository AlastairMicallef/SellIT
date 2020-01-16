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
            
            $itemsTable = TableRegistry::get("Friends");
            $item = $itemsTable->newEntity($this->request->getData());
            $item->user_id = $this->Auth->user('id');
            
            if(!empty($this->request->getData('uploadedPhoto')['name'])){
                $imgFileType = strtolower(pathinfo($this->request->getData('uploadedPhoto')['name'], PATHINFO_EXTENSION));
                
                if($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg" && $imgFileType != "gif" ) {
                    $this->Flash->error("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                    Log::warning("File has wrong extension. Upload tried by ".$this->Auth->user('first_name')." ".$this->Auth->user('last_name').", IP address:".$this->request->clientIp(), ['scope' => ['posts']]);
                    return $this->redirect(['action' => 'index']);
                }else{
                    $target_filePath = 'UploadedPhotos/'.time().$this->request->getData('uploadedPhoto')['name'];

                    if(move_uploaded_file($this->request->getData('uploadedPhoto')['tmp_name'], WWW_ROOT.$target_filePath)){
                        $post->Item_Image = $target_filePath;
                    }else{
                        $this->Flash->error("Your file was not uploaded.");
                        Log::warning("File was not uploaded. Upload tried by ".$this->Auth->user('first_name')." ".$this->Auth->user('last_name').", IP address:".$this->request->clientIp(), ['scope' => ['posts']]);
                    }
                }
            }
            
            if ($itemsTable->save($post)) {
                $this->Flash->success("Item added!");
                Log::info("Post Uploaded by ".$this->Auth->user('first_name')." ".$this->Auth->user('last_name').", IP address:".$this->request->clientIp(), ['scope' => ['posts']]);
                return $this->redirect(['action' => 'index']);
            }
            
            $errors = $itemsTable->errors();
            $error_msg = '';
            foreach ($errors as $error) {
                $error_msg .= array_values($error)[0]."<br/>";
            }
            $this->Flash->error('Unable to add a new item.<hr/>'.$error_msg, ['escape' => false]);
            Log::warning("A new item couldn't be created. Upload Post tried by ".$this->Auth->user('first_name')." ".$this->Auth->user('last_name').", IP address:".$this->request->clientIp(), ['scope' => ['posts']]);
        }
  
}
}