@include('emails.layouts.header')
<h1 style="Margin-top: 0;font-weight: 400;font-family: Georgia, serif;font-size: 32px;line-height: 42px;Margin-bottom: 24px">
    @yield('theme')
</h1>
<p style="Margin-top: 0;font-weight: 400;letter-spacing: -0.01em;font-family: Georgia, serif;-webkit-font-smoothing: antialiased;text-rendering: optimizeLegibility;Margin-bottom: 27px;font-size: 17px;line-height: 27px">
    @yield('body')
</p>
@include('emails.layouts.footer')