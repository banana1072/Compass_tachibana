<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    foreach($weeks as $week){ //その月の週の繰り返し
      $html[] = '<tr class="'.$week->getClassName().'">';
      $days = $week->getDays();
      foreach($days as $day){ //その月の一週間分の日付を繰り返す
        $startDay = $this->carbon->copy()->format("Y-m-01"); //その月の最初の日
        $toDay = $this->carbon->copy()->format("Y-m-d"); //今日の日付
        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){ //その月の最初の日から昨日までの場合
          $html[] = '<td class="past-day calendar-td">';
        }else{ //今日からその月の最後の日までの場合
          $html[] = '<td class="calendar-td '.$day->getClassName().'">';
        }
        $html[] = $day->render(); //日付を記述
        if(in_array($day->everyDay(), $day->authReserveDay())){ //予約を入れている場合
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart = "リモ1部";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
          } else{
            $reservePart = "受付終了";
          }
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            //その月の初日から昨日までの時に受付終了と表記する
            //予約を入れていた場合は受け付けた部を表示する
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">'.$reservePart.'</p></p>';
            $html[] = '<input type="hidden" name="getPart[]" value="'.$reservePart.'" form="reserveParts">';
          }else{ //今日からその月の最終日まで予約を入れていた場合
            $html[] = '<button type="submit" class="btn btn-danger p-0 w-75" name="delete_date" style="font-size:12px" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'">'. $reservePart .'</button>';
            $html[] = '<input type="hidden" name="getPart[]" value="'.$reservePart.'" form="reserveParts">';
          }
        }else{ //予約が入ってない場合
          //過去の予約は受付終了と表示する
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            //過去の分は受付終了とする
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">受付終了</p>';
            $html[] = '<input type="hidden" value="" name="getPart[]" form="reserveParts">';

          }else{
            //これからのものは予約フォームを設置する
              $html[] = $day->selectPart($day->everyDay());
          }
        }
        $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';
    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
