
<section class="content-header top">
    <h1 class="capitalize">
        {{ $breadcrumb[0] }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:void(0)" onclick="getViewContent('dashboard')" class="capitalize">Home</a></li>
        @if(!isset($breadcrumb[1]))
          <li class="active capitalize"><strong>{{ $breadcrumb[0] }}</strong></li>
        @elseif(isset($breadcrumb[1]))
          <li><a href="#" class="back capitalize">{{ $breadcrumb[0] }}</a></li>
          <li class="active capitalize"><strong id="breadcrumb-action">{{ $breadcrumb[1] }}</strong></li>
        @endif
    </ol>
</section>

@include('_partials.notifications')