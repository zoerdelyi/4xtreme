@extends('admin/layouts/admin')
@section('content')

@push('title') 
<title>Oldalak kezelése - {{ $page_name }} Admin</title>
@endpush

<h2 class="admin_title">Oldalak kezelése</h2>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Oldal neve</th>
      <th scope="col">Utolsó frissítés</th>
      <th scope="col">Létrehozva</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($pages as $page)
      <tr>
        <th scope="row"> {{ $page->id }}</th>
        <td> <a href="/admin/pages/{{ $page->id }}">{{ $page->name }}</a></td>
        <td> {{ date('Y. m. d. H:i', strtotime($page->updated_at)) }}</td>
        <td> {{ date('Y. m. d. H:i', strtotime($page->created_at)) }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection