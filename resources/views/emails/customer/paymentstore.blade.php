@component('mail::message')
<img style="width: 50% !important; margin-top: 12%; margin-left: 20%; position: absolute; height: 375px;" src="{{asset('media/content/cardMail.png')}}">

{{-- <p class="font-size: 1rem; margin-top: 25%;"><br><br></p> --}}

{{-- <p style="color: white; margin-left: 5%; font-size: 1.6rem; padding: 0px;"><b style="color: white; font-size: 1.4rem;">BrideAdvisor</b><b></b></p> --}}

<?=$addresses?>
<span><br><br><br></span>

<p style="color: rgb(245, 245, 245); margin-left: 28%; margin-top: -10% font-size: 1rem; padding: 0px;"><b style="color: white; font-size: 1.2rem;">NOMBRE</b><br>{{$name}}</p>

<p style="color: rgb(245, 245, 245); margin-left: 28%; font-size: 1rem; padding: 0px;"><b style="color: white; font-size: 1.2rem;">VALOR</b><br>${{$price}} MXN</p>

<img style="width:30%; margin-left:35%;" src="data:image/png;base64,{{ $img }}">

<span><br><br><br></span>

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

{{-- Thanks,<br>
{{ config('app.name') }} --}}
@endcomponent
