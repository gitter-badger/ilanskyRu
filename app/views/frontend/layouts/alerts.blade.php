@if(Session::has('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ Session::get('success') }}
</div>
@endif
@if(Session::has('info'))
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ Session::get('info') }}
</div>
@endif
@if(Session::has('warning'))
<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ Session::get('warning') }}
</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ Session::get('error') }}
</div>
@endif