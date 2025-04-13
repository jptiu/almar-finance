@props(['active' => false])
<!-- Employee Onboarding -->
<x-app.sidebar.onboarding-menu :active="in_array(Request::segment(2), ['onboarding'])" />

