<x-mail::message>
# Hello, {{ $firstName }}

We have successfully updated your user details 

Updated details are as follow:

First Name: {{ $firstName }}

Last Name: {{ $lastName }}

Role: {{ $role }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
