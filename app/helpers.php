<?php

use App\Models\User;

function is_prod() {
    return in_array(app()->environment(), ['prod', 'production']);
}

function is_non_prod() {
    return !is_prod();
}

function get_super_admin_email() {
    return User::getSuperAdmin('email');
}

function __getTokenForPostman() {
    $user = User::superAdmin()->first();
    $token = $user->tokens()->whereName('postman')->value('plainTextToken');

    if (! $token) {
        $token = $user->createToken('postman')->plainTextToken;
    }

    return $token;
}

function isDevpanelAutoLoginEnabled() {
    return !! env('SUPERADMIN_AUTO_LOGIN');
}

/*---LIVE CMS---------------*/
function get_templates_path() {
    return resource_path() . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;
}

function get_component_templates_path() {
    return get_templates_path() . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR;
}

function get_component_tags($content)
{
    $regx = '#<x-([a-z-]*)>#'; //<x-foo-bar>
    $matches = [];

    preg_match_all($regx, $content, $matches);

    return $matches[1];
}

function get_route_from_uri($page_slug) {
    $template_id = App\LiveCMS\Models\Template::where('route', $page_slug)->value('id');

    if ($template_id) {
        return route('cms.edit', $template_id);
    }
}
/*-----END LIVE CMS------------*/