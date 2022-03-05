<?php $this->load->view('includes/header'); ?>

<h1>Создание аккаунта!</h1>
<fieldset>
<legend>Персональная информация</legend>
<?php
   
echo form_open('login/create_member');

echo form_input('first_name', set_value('first_name', 'Ваше имя'));
echo form_input('last_name', set_value('last_name', 'Ваша фамилия'));
echo form_input('email_address', set_value('email_address', 'Email Address'));
?>
</fieldset>

<fieldset>
<legend>Информация о логине</legend>
<?php
echo form_input('username', set_value('username', 'Логин'));
echo form_input('password', set_value('password', 'Пароль'));
echo form_input('password2', 'Повторите пароль');

echo form_submit('submit', 'Создать аккаунт');
?>

<?php echo validation_errors('<p class="error">'); ?>
</fieldset>

<!--<?php $this->load->view('includes/tut_info'); ?>-->

<?php $this->load->view('includes/footer'); ?>