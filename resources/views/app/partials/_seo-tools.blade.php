@php
    SEO::setTitle(settings('site.title'));
    SEO::setDescription(settings('site.description'));
    SEO::opengraph()->addProperty('locale', 'pl_PL');
    SEO::opengraph()->addProperty('type', 'website');
    SEO::opengraph()->setUrl(url('/'));
    SEO::opengraph()->addImage(asset('images/facebook.png'));
    SEO::opengraph()->addProperty('site_name', settings('site.name'));
@endphp

{!! SEO::generate(true) !!}