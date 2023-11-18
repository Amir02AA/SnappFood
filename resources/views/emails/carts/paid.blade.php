<x-mail::message>
# Introduction

Dear {{$cart->user->name}} Your cart has been paid. Please Wait til your order is ready for you.
    Cart id : {{$cart->id}}
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
