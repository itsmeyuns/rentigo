@extends('layouts.master-pdf')
@section('title', 'Les Charges')
@section('table')
  <div class="table-container">
    <table class="table">
      <thead>
        <tr>
          <th>Date</th>
          <th>Type Charge</th>
          <th>Coût</th>
          <th>Observation</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($charges as $charge)
            <tr>
              <td>{{$charge->date}}</td>
              <td>{{$charge->type}}</td>
              <td>{{$charge->cout}}</td>
              <td>{{$charge->observation}}</td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <p>Nombre de lignes: <b>{{$charge->count()}}</b></p>
@endsection

