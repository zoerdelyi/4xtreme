@if ($user->sex == 1)
    <img class="img-height-40 rounded-circle" src="https://bootdey.com/img/Content/user_1.jpg" alt="">
@elseif ($user->sex == 2)
    <img class="img-height-40 rounded-circle" src="https://bootdey.com/img/Content/user_2.jpg" alt="">
@else
    <img class="img-height-40 rounded-circle" src="https://bootdey.com/img/Content/user_1.jpg" alt="">
@endif