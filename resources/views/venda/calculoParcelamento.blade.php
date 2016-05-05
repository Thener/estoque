<div style="clear: both;"></div>
<table class="table table-condensed table-hover" style="width: 400px;">
	<thead>
		<tr style="background-color: #E6E6E6">
			<th style="width: 80px; text-align: center;">Parcela</th>
			<th style="text-align: center;">Vencimento</th>
			<th style="width: 120px;text-align: right;">Valor</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($listaParcelas as $key => $parc)
	<tr>
		<td style="text-align: center;">{{ $parc['numero_parcela'] }}</td>
		<td style="text-align: center;">{{ $parc['data_vencimento'] }}</td>
		<td style="text-align: right;">{{ $parc['valor_parcela'] }}</td>
	</tr>
	@endforeach
	<tr style="background-color: #E6E6E6;">
		<td colspan="2" align="right">Total Parcelado R$ </td>
		<td style="text-align: right;">
			{{ $valorTotalParcelado }}
		</td>
	</tr>
	</tbody>
</table>