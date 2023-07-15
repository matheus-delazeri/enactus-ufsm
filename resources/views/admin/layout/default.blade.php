@php
    $prefix = "admin.";
    $menu = $menu ?? true;
    $footer = $footer ?? true;
@endphp
<html lang="pt-br">

@include($prefix.'block.head')

<body>

@include($prefix.'block.messages')
<div class="container h-100 mw-100">

    <div id="main" class="row h-100 align-items-center">

        @if($menu)
            @include($prefix.'block.menu')
            <div class="content col-md-10 col-sm-12 h-100 py-4" style="overflow-y: auto">
                <div class="mw-100 p-4">
                    @yield('content')
                </div>
            </div>
        @else
            <div class="content col-md-12">
                @yield('content')
            </div>
        @endif

    </div>

    @if($footer)
        <footer class="row">

            @include($prefix.'block.footer')

        </footer>
    @endif

</div>

</body>
</html>
