<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Cake\Log\Log;

class APIController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['getItemByUser', 'deleteItem', 'addItem', 'getCommentsFromItems']);
    }

    public function getItemByUser($user_id){
        //GET
        if($this->request->is('get')){
            $newitem = TableRegistry::get("Items");
            $feed = $newItem->find('all')->where(array("AND"=>array("Items.user_id"=>$user_id)))->contain('Comments')->toArray();
            $this->set('feed', $feed);
        }
    }

    public function deleteItem($item_id){
        //DELETE
        if($this->request->is('delete')){
            $itemTable = TableRegistry::get("Items");
            $item = $itemTable->get(['Item_ID' =>$post_id]);
            if($item['Item_Image'] != ""){
                unlink(WWW_ROOT.$post['Item_Image']);
            }
            $itemTable->delete($item);
            Log::info("Item Deleted. Item ID: ".$item." IP address:".$this->request->clientIp(), ['scope' => ['Items']]);
            $this->set(['return' => array('Deleted' => 'true'), '_serialize' => ['return']]);
        }
    }

    public function addItem(){
        //AddItem
        if($this->request->is('post')){
            $return;
            $itemsTable = TableRegistry::get("Items");
            $item = $itemsTable->newEntity($this->request->getData());
            $item->user_id = $this->request->getData('user_id');
            //$item->slug = time().Inflector::slug($post->post_content);
            
            if(!empty($this->request->getData('uploadedPhoto')['name'])){
                $imgFileType = strtolower(pathinfo($this->request->getData('uploadedPhoto')['name'], PATHINFO_EXTENSION));
                
                if($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg" && $imgFileType != "gif" ) {
                    $this->Flash->error("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                    Log::warning("File has wrong extension. IP address:".$this->request->clientIp(), ['scope' => ['Items']]);
                    $return= array('Added' => 'false', 'error' => 'File has wrong extension.');
                }else{
                    $target_filePath = 'UploadedPhotos/'.time().$this->request->getData('uploadedPhoto')['name'];

                    if(move_uploaded_file($this->request->getData('uploadedPhoto')['tmp_name'], WWW_ROOT.$target_filePath)){
                        $item->Item_Image = $target_filePath;
                    }else{
                        $this->Flash->error("Your file was not uploaded.");
                        Log::warning("File was not uploaded IP address:".$this->request->clientIp(), ['scope' => ['Items']]);
                        $return=array('Added' => 'false', 'error' => 'File was not uploaded.');
                    }
                }
            }
            
            if ($itemsTable->save($post)) {
                $this->Flash->success("Iten Added!");
                Log::info("Item Added. IP address:".$this->request->clientIp(), ['scope' => ['posts']]);
                $return= array('Added' => 'true');
            }else{
                $errors = $itemsTable->errors();
                $error_msg = '';
                foreach ($errors as $error) {
                    $error_msg .= array_values($error)[0]."<br/>";
                }
                $this->Flash->error('Unable to add a new Item.<hr/>'.$error_msg, ['escape' => false]);
                Log::warning("A new item couldn't be created. IP address:".$this->request->clientIp(), ['scope' => ['posts']]);
                $return=array('Added' => 'false', 'error' => 'Error occurred, Try again later.');
            }
            $this->set(['return'=>$return, '_serialize' => ['return']]);

        }
    }

    public function getCommentsFromItem($item_id){
        //GET
        if($this->request->is('get')){
            $this->set(['return'=>TableRegistry::get("Comments")->find('all')->contain('Users')->where(array('AND' => array('Comments.Comment_ID' => $item_id)))->toArray(), '_serialize' => ['return']]);
        }
    }
}
?>