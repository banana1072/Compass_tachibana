@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-50 m-auto h-75">
    <p><span>{{ $date }}日</span><span class="ml-3">{{ $part }}部</span></p>
    <div class="h-75 border">
      <table class="">
        <tr class="text-center">
          <th class="w-25">ID</th>
          <th class="w-25">名前</th>
          <th class="w-25">場所</th>
        </tr>
          @if(!empty($user_id))
          @foreach($user as $user_list)
        <tr class="text-center">
          <td class="w-25">{{ $user_list->pluck('id')->first() }}</td>
          <td class="w-25">{{ $user_list->pluck('over_name')->first()}}{{ $user_list->pluck('under_name')->first() }}</td>
          <td class="w-25">リモート</td>
        </tr>
          @endforeach
          @endif

      </table>
    </div>
  </div>
</div>
@endsection
