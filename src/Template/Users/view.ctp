<?php

foreach ($users as $user) {
    ?>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo $user->firstName; echo $user->lastName ?></h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <?php if($friends->exists(['Friend_ID' => '32', 'Friend_ID' => $user->User_ID])){ ?> 
        <?php echo $this->Form->postButton('Unfollow', ['controller' => 'Users', 'action' => 'RemoveFriend',$user->User_ID], ['class' => ' btn btn-outline-success']);
         } else{
        
        echo $this->Form->postButton('Add Friend', ['controller' => 'Users', 'action' => 'Adduser',$user->User_ID], ['class' => ' btn btn-outline-success']);
        }?>
      </div>
</div>

<?php
}
?>
