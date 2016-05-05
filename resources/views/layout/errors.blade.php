<script>

	$(document).ready(function() {
		
		$('.alert-danger').click(function () {
			$(this).remove();
		});
	
	});
	
	function hide() {
		$('.alert-danger').fadeOut();
	}
	
	setTimeout(hide, 7000);

</script>

<style>
	.alert-danger {
		cursor: pointer;
	}
</style>

@if (count($errors->all()) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
@endif

@if (Session::get('message') != '')
	<div class="alert alert-danger">
		<ul>
			<li>{{ Session::get('message') }}</li>
		</ul>
	</div>
	{{ Session::set('message', null) }}
@endif