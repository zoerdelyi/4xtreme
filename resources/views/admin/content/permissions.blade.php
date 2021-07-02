@extends('admin/layouts/admin') 
@section('content')

@push('title') 
<title>Jogosultságok - {{ $page_name }} Admin</title>
@endpush

<h2>Jogosultságok</h2>
<div class="table-responsive">
   <table class="table table-bordred table-striped">
      <thead>
         <th>Jogosultság neve</th>
         @foreach ($levels as $level)
         <th>{{$level->name}}</th>
         @endforeach
         {{-- <th class="minimal-width">
            <button class="btn btn-success"><i class="fa fa-plus"></i></button>
         </th> --}}
      </thead>
      <tbody>
         @foreach ($permissions as $perm_index => $permission)
         @if($perm_index != 2 && $perm_index != 3)
         <tr>
            <td>{{$permission->name}}</td>
            @foreach ($permission->levelArray as $level)
            <td>
               <label class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" data-permission-id="{{$permission->id}}" data-level-id="{{$level->id}}" {{$level->checked == 1 ? 'checked' : ''}}>
                  <span class="custom-control-indicator"></span>
               </label>
            </td>
            @endforeach
            {{-- <td>&nbsp</td> --}}
         </tr>
         @endif
         @endforeach
      </tbody>
   </table>
</div>
@endsection

@push('styles')
   <!-- Dinamikus stílus fájlok: -->
   <!-- Custom CSS -->
   <link href="/adminset/css/custom/permission.css" rel="stylesheet" />
@endpush
@push('scripts')
   <!-- Dinamikus script fájlok: -->
   <!-- Custom JS -->
   <script type="text/javascript" src="/adminset/js/custom/permissions.js"></script>
@endpush