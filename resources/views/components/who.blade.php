{{-- We are checking whether a user is logged in or not in component using guard so even if one is logged in as admin he is logged out as a user --}}
@if (Auth::guard('web')->check())
    <p class="text-success">
        You are logged in as normal user
    </p>
@else
<p class="text-danger">
    You are logged out as the normal user
</p>
@endif

{{-- To check for the admin --}}
@if (Auth::guard('admin')->check())
    <p class="text-success">
        You are logged in as admin user
    </p>
@else
<p class="text-danger">
    You are logged out as the admin user
</p>
@endif