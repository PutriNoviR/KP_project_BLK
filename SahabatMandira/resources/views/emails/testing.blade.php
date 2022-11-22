@component('mail::message')
# Introduction

I AM ATOMIC !!!

@component('mail::button', ['url' => '#'])
RUMAH MANDIRA
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
