@extends('layouts.sidebar')

@section('content')
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto border" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary mt-2" value="予約する" form="reserveParts">
    </div>
    <div class="modal js-modal">
      <div class="modal__bg js-modal-close">
      </div>
      <div class="modal__content">
        <div class="w-100">
          <div class="modal-top-detail">
            <div>
              <span>予約日:</span><p class="modal-inner-reserveDate"></p>
            </div>
            <div>
                <span>時間：</span><p class="modal-inner-reservePart"></p>
            </div>
          </div>
          <div class="w-50 m-auto edit-modal-btn d-flex">
            <a class="js-modal-close btn btn-primary d-inline-block" href="">閉じる</a>
            <input type="hidden" class="edit-modal-hidden" name="post_id" value="" form="deleteParts">
            <input type="submit" class="btn btn-danger d-block" value="キャンセル" onclick="return confirm('本当にキャンセルしますか？')" form="deleteParts">
            <input type="hidden" form="deleteParts" value="" name="deleteDate" class="submit-delete-date">
            <input type="hidden" form="deleteParts" value="" name="deletePart" class="submit-delete-part">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
