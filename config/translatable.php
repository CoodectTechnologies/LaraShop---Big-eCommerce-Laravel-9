<?php

return [

    /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    |
    | status definirá en el sistema si habrá multilenguaje en bases de datos y web
    | Si se define como falsa, solo se tomará el lenguaje por default como predeterminado en db y web
    | Si se define como verdadera, se podrá generar registros en db y web con multilenguaje
    |
    */
    'status' => (bool) env('TRANSLATABLE_STATUS', false),

    /*
    |--------------------------------------------------------------------------
    | FALLBACK LOCALE
    |--------------------------------------------------------------------------
    |
    | fallback definirá en el sistema que registro de db tomar en dado caso que no exista el idioma en la db de la sesion del sistema
    |
    */
    'fallback' => env('TRANSLATABLE_FALLBACK', null),

    /*
    |--------------------------------------------------------------------------
    | COUNTRIES
    |--------------------------------------------------------------------------
    |
    | countries registra los lenguajes de los paises
    | El sistema detecta el pais en base a la localizacion (Location::get(request()->ip()), y en base a este obtiene el lenguaje
    | El pais debe coincidir con el pais retornado de (Location::get(request()->ip()) usados en (app\Http\Middleware\CurrencySwitcher.php, app\Http\Middleware\LanguageSwitcher.php)
    |
    */
    'countries' => [
        'Mexico' => [
            'code' => 'MX',
            'language' => 'es',
            'language_code' => 'es_MX',
            'currency_code' => 'MXN'
        ],
        'Spain' => [
            'code' => 'ES',
            'language' => 'es',
            'language_code' => 'es_ES',
            'currency_code' => 'EUR'
        ],
        'United States' => [
            'code' => 'US',
            'language' => 'en',
            'language_code' => 'en_US',
            'currency_code' => 'USD'
        ],
        'Canada' => [
            'code' => 'CA',
            'language' => 'en',
            'language_code' => 'en_CA',
            'currency_code' => 'CAD'
        ],
        'United Kingdom' => [
            'code' => 'GB',
            'language' => 'en',
            'language_code' => 'en_GB',
            'currency_code' => 'GBP'
        ],
        'Argentina' => [
            'code' => 'AR',
            'language' => 'es',
            'language_code' => 'es_AR',
            'currency_code' => 'ARS'
        ],
        'Brazil' => [
            'code' => 'BR',
            'language' => 'pt',
            'language_code' => 'pt_BR',
            'currency_code' => 'BRL'
        ],
        'Chile' => [
            'code' => 'CL',
            'language' => 'es',
            'language_code' => 'es_CL',
            'currency_code' => 'CLP'
        ],
        'Colombia' => [
            'code' => 'CO',
            'language' => 'es',
            'language_code' => 'es_CO',
            'currency_code' => 'COP'
        ],
        'Peru' => [
            'code' => 'PE',
            'language' => 'es',
            'language_code' => 'es_PE',
            'currency_code' => 'PEN'
        ],
        'Uruguay' => [
            'code' => 'UY',
            'language' => 'es',
            'language_code' => 'es_UY',
            'currency_code' => 'UYU'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | LOCALES
    |--------------------------------------------------------------------------
    |
    | locales registra los lenguajes que estarán habilitados en el sistema, minimo se necesitara 1 lenguaje
    | Asegurate de corroborar que exista un país con el lenguaje que agreges, si no existe deberás crearlo.
    | De lo contrario se tomara el lenguaje por default (.env fallback)
    |
    */
    'locales' => [
        'es' => [
            'name' => 'Español',
            'flag' => env('APP_URL', 'https://localhost').'/assets/admin/media/flags/es.png'
        ],
        'en' => [
            'name' => 'English',
            'flag' => env('APP_URL', 'https://localhost').'/assets/admin/media/flags/en.png'
        ]
    ],
];
