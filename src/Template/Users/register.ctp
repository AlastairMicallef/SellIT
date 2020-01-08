<div class="users form">
<?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?= $this->Form->control('firstName') ?>
        <?= $this->Form->control('lastName') ?>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
   </fieldset>
<?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end() ?>
</div>