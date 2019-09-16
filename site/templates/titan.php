<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="google" content="notranslate">
    <meta http-equiv="Content-Language" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Titan SPA</title>
    <?= css('assets/titan/css/titan.css') ?>
    <style>
        [v-cloak] { display: none; }
    </style>
</head>
<body class="bg-blue-300 leading-normal antialiased">
    <div id="app" class="min-h-screen bg-cover bg-center">
      <!-- <VuexLoader
        :user="{{ $user }}"
        s3_bucket="{{env('AWS_BUCKET')}}"
        avatar_path="{{ env('S3_USER_PROFILE_IMAGES')}}"
        :lang="{{json_encode(array_merge(Lang::get('parentDashboard')))}}" 
      /> -->
      <router-view />
      
    </div>

      <?= js('assets/titan/js/titan.js') ?>
</body>
</html>
