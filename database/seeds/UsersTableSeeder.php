<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0;$i<9;$i++){
            $sex = mt_rand(1,2);
            $role = mt_rand(1, 4);
            $under_name = '';
            $under_name_kana = '';

            if($sex==1){
                $under_name = '太郎';
                $under_name_kana = 'タロウ';
            }
            else{
                $under_name = '子';
                $under_name_kana ='コ';
            }

            DB::table('users')->insert([
                [
                'over_name' => '0'.(string)$i.'lull',
                'under_name' => (string)$i.$under_name,
                'over_name_kana' => '0'.(string)$i.'ラル',
                'under_name_kana' => (string)$i.$under_name_kana,
                'mail_address' => 'lull0'.(string)$i.'@mail.com',
                'sex' => $sex,
                'birth_day' => '2003-01-0'.(string)($i+1),
                'role' => $role,
                'password' => '0'.(string)$i.'pass',
                'created_at'=>now(),
                ]
            ]);
        }
    }
}
