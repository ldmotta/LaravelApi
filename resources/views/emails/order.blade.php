@component('mail::message')

<h1>Olá {{ $data['nome'] }}</h1>

<p>Seguem os dados do seu pedido:</p>

<table>
<thead>
    <tr>
        <th>Cod.</th>
        <th>Descrição:</th>
        <th>Valor Unitário</th>
        <th>Quantidade</th>
        <th>Valor Total:</th>
    </tr>  
</thead>
<tbody>
@foreach ($data['products'] as $pastel)
<tr>
    <td>{{ $pastel->id }}</td>    
    <td style="padding-right: 20px">{{ $pastel->nome }}</td>
    <td>@convert($pastel->preco)</td>
    <td>{{ $pastel['quantidade'] }}</td>
    <td>@convert($pastel->total)</td>
</tr>
@endforeach
</tbody>
<tfoot>
    <tr>
      <td colspan="4">Total</td>
      <td>@convert($data['subtotal'])</td>
    </tr>
  </tfoot>
</table>

<div style="margin-top:60px">
Obrigado,<br>
</div>
{{ config('app.name') }}
@endcomponent
