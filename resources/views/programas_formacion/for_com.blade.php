@extends('layouts.app')
@section('title', 'Portafolio CPIC')

@section('content')
<div class="col-md-12">
<h1 class="text-center">Programas de formación</h1>

	@if(Auth::check())
	<a class="btn btn-success" href="{{ url('programas/create') }}">
		Adicionar Programa
	</a>
	<br>
<br>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar por nombre" class="form-control">



<div class="table-responsive">
	<table class="table table-bordered text-center"  id="myTable">
		<tr>
			<th>Nombre Programa</th>
			<th>Descripción Programa</th>


			<th colspan="3">Acciones</th>

		</tr>
		@foreach($programs as $pro)
		<tr>
			<td>{{$pro->nombre_programa}}</td>
			<td>{{$pro->descripcion_programa}}</td>


			<td><a href="{{ url('programas/'.$pro->id) }}" class="btn btn-default"><i class="fa fa-search"></i></a></td>
			<td><a href="{{ url('programas/'.$pro->id.'/edit') }}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i></a></td>
			<td>
				<form action="{{ url('programas/'.$pro->id) }}" method="POST" style="display: inline-block;">
					{{ method_field('delete') }}
					{!! csrf_field() !!}
					<button class="btn btn-delete btn-default"><i class="fa fa-times"></i></button>
				</form>
			</td>
		</tr>
		@endforeach
	</table>
</div>
</div>

@endif
@if(Auth::guest())

<a href="/">Regresar</a>
<hr>
<div class="container">
	<div class="row">


		<div class="col-md-6 panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title" class="animated bounceInLeft" >
							<a role="button"  data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Tecnologos
							</a>
						</h4>
					</div>
				@php
					$count=50;
					$cont=50;
					@endphp
				@foreach($programs as $pro)
				@if($pro->tipo_programa == 'Tecnologia')
				<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSOne">
					<div class="panel-body">
						<div class="panel-group" id="sub-accordion" role="tablist" aria-multiselectable="true">
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingsOne">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" data-parent="#sub-accordion" href="#collapses{{$count++}}" aria-expanded="true" id="button_co" aria-controls="collapsesOne">
											{{$pro->nombre_programa}} 
										</a>
									</h4>
								</div>
								<div id="collapses{{$cont++}}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingsOne">
									<div class="panel-body" id="panel-body">
										{{$pro->descripcion_programa}}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endif
				@endforeach	
				</div>
			</div>
		</div>

	</div>
</div>
	

@endif

@endsection
@push('scripts')
<script>

		               function myFunction() {
      // Declare variables 
      var input, filter, table, tr, td, i;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        } 
      }
    }

   
</script>
@endpush