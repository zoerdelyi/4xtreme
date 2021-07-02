@extends('admin/layouts/admin')
@section('content')

@push('title') 
<title>Felhasználók kezelése - {{ $page_name }} Admin</title>
@endpush

<h2>Felhasználók kezelése</h2>
<div class="table-responsive">
   <table id="dtBasicExample" class="table table-striped">
      <thead>
         <th scope="col">
            <label>Felhasználó neve</label>
         </th scope="col">
         <th scope="col">
            <label>Beosztás</label>
         </th>
         <th scope="col">
            <label>E-mail</label>
         </th>
         <th scope="col">
            <button id="createUserModal" class="btn btn-success"><i class="fa fa-plus"></i></button>
         </th>
      </thead>
      <tbody>
         @foreach ($users as $user)
         <tr>
            <td class="userDetails" data-user-id="{{$user->id}}">
               <p>{{$user->name}}</p>
            </td>
            <td class="userDetails" data-user-id="{{$user->id}}">
               {{-- <div class="rounded @if ($user->level_id->id == 1) {{'bg-success'}} @else {{'bg-danger'}} @endif"> --}}
                  <p class="user-status">{{$user->level_id->name}}</p>
               {{-- </div> --}}
            </td>
            <td class="userDetails" data-user-id="{{$user->id}}">
               <p>{{$user->email}}</p>
            </td>
            <td>
               @if (Auth::user()->id != $user->id)
                  <button class="btn btn-danger userDelete" data-user-id="{{$user->id}}""><i class="fas fa-trash-alt"></i></button>
               @endif
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
   @include('admin.content.modals.user-modal')
   @include('admin.content.modals.delete-confirm')
@endsection

<!-- Dinamikus stílus fájlok ide: -->
@push('styles')
   <!-- Custom CSS -->
   <link href="/adminset/css/custom/user.css" rel="stylesheet" />
@endpush
<!-- Dinamikus script fájlok ide: -->
@push('scripts')
   <!-- Custom JS -->
   <script src="/adminset/js/bootstrap-notify.js" type="text/javascript"></script>
   <script type="text/javascript" src="/adminset/js/custom/users.js"></script>
   <script type="text/javascript" src="/adminset/js/custom/user-delete-modal.js"></script>
@endpush