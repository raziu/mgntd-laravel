@if (count($user_links) > 0)
  <div class="profile-links">
      <ul>
      @foreach ($user_links as $link)
        @if(Request::url() === $link->link)
          @php $class = 'active'; @endphp
        @else
          @php $class = ''; @endphp
        @endif
        <li class="{{ $class }}"><a href="{{ $link->link }}">{{ __("$link->name") }}</a></li>
      @endforeach
      </ul>
    </div>
@endif