<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>
    * {
      font-family: "Poppins", sans-serif;
    }
    @page {width: 100%; height: 100%;}
    .table {
      margin: auto;
      width: 100%;
      border-collapse: collapse;
    }
    .table th {text-transform: capitalize;}
    .table tr {
      border-bottom: 1px solid #ddd;
      background-color: #f5f9fc;
    }
    .table thead tr:first-child {
      border-top: none;
      background: #2962ff;
      color: #fff;
    }
    .table tr:nth-child(odd) {
      background-color: #ebf3f9;
    }

    .table td:last-child {
      margin-bottom: .5em;
    }

    .table th,
    .table td {
      display: table-cell;
      text-align: left;
      padding: 1em !important;
    }
    .table th:first-child,
    .table td:first-child {
      padding-left: 0;
    }
    .table th:last-child,
    .table td:last-child {
      padding-right: 0;
    }
  </style>
  <title>@yield('title')</title>
</head>
<body>
  <p style="text-align: right">{{now()->format('d/m/Y H:i')}}</p>
  <h1>@yield('title')</h1>
  @yield('table')
</body>
</html>