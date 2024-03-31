@component('mail::message')
Hello {{$user->name}} ,

<p> we understand it happens</p>

@component('mail::button', ['url' => url('reset/' . $user->remember_token)])


        Reset Your Password

 @endcomponent

 <p>in case you have any issues recovering your password, please contact us.</p>
Thanks, <br>
{{ config('app.name')}}
@endcomponent