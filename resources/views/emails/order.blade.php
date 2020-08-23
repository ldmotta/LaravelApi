@component('mail::message')

<h1>Olá {{ $data['name'] }}</h1>

<p>Seguem os dados do seu pedido:</p>

<table>
    <thead>
        <tr>
            <th>Cod.</th>
            <th>Descrição:</th>
            <th>Valor:</th>
        </tr>  
    </thead>
    <tbody>

        <tr>
            <td>{{ $data->id }}</td>    
            <td style="padding-right: 20px">{{ $data->name }}</td>
            <td>@convert($data->price)</td>
        </tr>

    </tbody>
</table>

<div style="margin-top:60px">
Obrigado,<br>
</div>
{{ config('app.name') }}
@endcomponent
