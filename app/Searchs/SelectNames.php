<?php
namespace App\Searchs;

use App\Models\Users\User;

class SelectNames implements DisplayUsers{

  public function resultUsers($keyword, $category, $updown, $gender, $role, $subjects){
    if(empty($gender)){
      $gender = ['1', '2'];
    }else{
      $gender = array($gender);
    }
    if(empty($role)){
      $role = ['1', '2', '3', '4'];
    }else{
      $role = array($role);
    }
    if(empty($subjects)){
      $subjects = ['国語', '数学', '英語'];
    }
    $users = User::with('subjects')
      ->where(function ($q) use ($keyword) {
        $q->where('over_name', 'like', '%' . $keyword . '%')
          ->orWhere('under_name', 'like', '%' . $keyword . '%')
          ->orWhere('over_name_kana', 'like', '%' . $keyword . '%')
          ->orWhere('under_name_kana', 'like', '%' . $keyword . '%');
      })
      ->whereIn('sex', $gender)
      ->whereIn('role', $role)
      ->whereHas('subjects', function ($q) use ($subjects) {
        $q->whereIn('subject', $subjects);
    })
      ->orderBy('over_name_kana', $updown)->get();

    return $users;
  }
}
