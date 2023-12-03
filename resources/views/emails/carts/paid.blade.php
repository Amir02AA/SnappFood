<x-mail::message>
# Introduction

Dear {{$order->user->name}} Your order has been paid. Please Wait til your order is ready for you.
    Cart id : {{$order->id}}
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
