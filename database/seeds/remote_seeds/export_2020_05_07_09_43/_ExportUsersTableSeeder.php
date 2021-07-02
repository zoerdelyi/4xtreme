<?php

use Illuminate\Database\Seeder;

class _ExportUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 7,
                'name' => 'Admin',
                'email' => 'info@4xtreme.hu',
                'email_verified_at' => NULL,
                'bornDate' => NULL,
                'sex' => NULL,
                'telephone' => NULL,
                'password' => '$2y$10$1Hhg4tanHDThnRpNZuH8qOqqfdpRsi37lQEyEyVr6K9LLFM9MuK9W',
                'remember_token' => 'WxUvblLQvKDxWBRXHUj0N4ZO7U3xRtLum4jQtFzYpMvtVsgRWVI5nzFeISLs',
                'created_at' => '2019-08-30 17:11:23',
                'updated_at' => '2019-09-06 12:45:43',
                'level_id' => 1,
            ),
            1 => 
            array (
                'id' => 11,
                'name' => 'Veronika',
                'email' => 'vera.erdelyi@gmail.com',
                'email_verified_at' => NULL,
                'bornDate' => NULL,
                'sex' => NULL,
                'telephone' => NULL,
                'password' => '$2y$10$Za9H4NsQ5BSAYtxLBrdP/OaLjY4ymJmXSjAaeF/RO.0DgxxCVNmZu',
                'remember_token' => 'cJMkLUnMLrgQyUz9tU220XERrge1ZHAzfHNYIK0E5KHnbTm5Usckmh5f7lTw',
                'created_at' => '2019-09-06 12:46:45',
                'updated_at' => '2019-09-14 15:20:48',
                'level_id' => 2,
            ),
            2 => 
            array (
                'id' => 12,
                'name' => 'Lacus',
                'email' => 'szabolaszlo460@gmail.com',
                'email_verified_at' => NULL,
                'bornDate' => NULL,
                'sex' => NULL,
                'telephone' => NULL,
                'password' => '$2y$10$YA6EDTPVO.zTel6VUmvRtu/jFUTavZOgnnLzt8YyhidbiYetVzuk6',
                'remember_token' => NULL,
                'created_at' => '2019-09-06 12:52:01',
                'updated_at' => '2019-09-06 12:52:01',
                'level_id' => 2,
            ),
            3 => 
            array (
                'id' => 13,
                'name' => 'Otpapa',
                'email' => 'erdelyi.zoli64@gmail.com',
                'email_verified_at' => NULL,
                'bornDate' => NULL,
                'sex' => NULL,
                'telephone' => NULL,
                'password' => '$2y$10$v00LqRwMbwSXAHz1jKoK8u3o99MV73w4m3LWg/nyb1qKMpXPJP9hS',
                'remember_token' => 'GMwHKwsfGRQPQTT5CXwj6hvjP5jt4d8VP6GXEhV7nmH5kUuFKhgJTaDhfyKy',
                'created_at' => '2019-09-08 16:28:36',
                'updated_at' => '2019-09-08 16:29:04',
                'level_id' => 2,
            ),
            4 => 
            array (
                'id' => 14,
                'name' => 'Norbi',
                'email' => 'ernorbi@gmail.com',
                'email_verified_at' => NULL,
                'bornDate' => NULL,
                'sex' => NULL,
                'telephone' => NULL,
                'password' => '$2y$10$pVo7TF7R.0o/BoB5a9P6FexxCXR6v3XL14wCAyhKz821i5rMB6jUe',
                'remember_token' => NULL,
                'created_at' => '2020-04-07 18:14:40',
                'updated_at' => '2020-04-07 18:14:40',
                'level_id' => 2,
            ),
        ));
        
        
    }
}