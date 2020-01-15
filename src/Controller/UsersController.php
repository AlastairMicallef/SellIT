<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;



class UsersController extends AppController
{
     public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('add');
        $this->Auth->allow(['add', 'logout']);
    }
    
    public function register()
    {
         $usersTable = TableRegistry::get("Users");
            
        if ($this->request->is('post')) {

            $newUser = $usersTable->newEntity($this->request->getData());
            $newUser->slug = Inflector::slug($newUser->email);
            if ($usersTable->save($newUser)) {
                //$this->Flash->success("User saved!");
                return $this->redirect(['action' => 'register']);
            }
            
            $errors = $newUser->errors();
            $error_msg = '';
            foreach ($errors as $error) {
                $error_msg .= array_values($error)[0]."<br/>";
            }
            $this->Flash->error('Unable to add a new user.<hr/>'.$error_msg, ['escape' => false]);
        }
        
        $this->set('user', $usersTable->newEntity());
    }
    


    public function login()
    { //if user is already logged in, redirect!
        if ($this->Auth->user('id'))return $this->redirect(['controller'=>'Items','action' => 'index']);
        
        if ($this->request->is('post')) {
            
            $user = $this->Auth->identify();
    
            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success('You are now logged in!');
                return $this->redirect(['controller'=>'Items','action' => 'index']);
            }
            $this->Flash->error('Your username or password is incorrect.');
            return $this->redirect(['action' => 'login']);
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
     public function view()
    {
        $this->set('friends', TableRegistry::get("friends"));
		$usersTable = TableRegistry::getTableLocator()->get('Users');

		$usersTable = $this->Users;
         
		$query = $usersTable->find();
		
		$allUsers = $query->toArray();
		
		$this->set("users", $allUsers);
          
     }
    
   
    
    public function Adduser($user_id){
        var_dump($user_id);
        if ($this->request->is('post')) {
            $addTable = TableRegistry::get("Friends");
            $newfriend = $addTable->newEntity(['Friend_ID' => $this->Auth->user('id'), 'Friend_ID' => $user_id,'Friend_Request' => '34','Accepted' => '1']);
            $addTable->save($newfriend);
            
            return $this->redirect($this->referer());
        }
    }
    public function RemoveFriend($user_id){
        var_dump($user_id);
        if ($this->request->is('post')) {
            $removeTable = TableRegistry::get("Friends");
            $newFriend = $removeTable->get(['Friend_ID' => $this->Auth->user('id'), 'Friend_ID' => $user_id]);
            $removeTable->delete($newFriend);
            return $this->redirect($this->referer());
        }
    }
}