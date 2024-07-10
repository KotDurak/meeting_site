<?php

/**
 * @var \App\Models\User $user
*/

?>

<div>
    <p>Здравствуйте {{$user->name}} ,  ваш код для регистрации на сайте {{env('APP_NAME')}}</p>
    <p>
        <b>{{$user->sms}}</b>
    </p>
</div>

