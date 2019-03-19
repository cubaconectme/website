@extends('layouts.app')
@section('content')
  <template v-if="{{ json_encode(Auth::check())}}">
   <nav-bar
           :home_url="{{ json_encode(url('/')) }}"
           :app_name="{{ json_encode(config('app.name', 'Laravel')) }}"
           :is_guest="{{ json_encode(!Auth::check())}}"
           :roles="{{ json_encode($user->getRolesArray()) }}"
           :user="{{ json_encode($user) }}"
           :token_csrf="token_csrf"
   ></nav-bar>
   <main class="container">
    <body-content
            :card_type="'primary'"
    >
    </body-content>
   </main>
  </template>
@endsection
