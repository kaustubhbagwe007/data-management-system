<x-mail::message>
# Hello, {{ $firstName }}

Welcome to data management system.

Your login credentials for role {{ $role }} are:

Email: {{ $email }}

Password: {{ $password }}

<x-mail::button :url="$url">
Click Here To Login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
