管理画面アカウントが発行されました。<br>
<br>
以下のURLからログインして、本登録を完了させてください。<br>
{{route('admin.member.register',['token' => $token])}}<br>
仮パスワード:{{$random_password}}
