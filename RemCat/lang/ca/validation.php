<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Línies de Llenguatge de Validació
    |--------------------------------------------------------------------------
    |
    | Les següents línies de llenguatge contenen els missatges d'error per defecte utilitzats per
    | la classe de validador. Algunes d'aquestes regles tenen diverses versions, com
    | les regles de mida. Si us plau, siéntaseu-vos lliures d'ajustar cadascun d'aquests missatges aquí.
    |
    */

    'accepted' => 'El camp :attribute ha de ser acceptat.',
    'accepted_if' => 'El camp :attribute ha de ser acceptat quan :other és :value.',
    'active_url' => 'El camp :attribute no és una URL vàlida.',
    'after' => 'El camp :attribute ha de ser una data posterior a :date.',
    'after_or_equal' => 'El camp :attribute ha de ser una data posterior o igual a :date.',
    'alpha' => 'El camp :attribute només pot contenir lletres.',
    'alpha_dash' => 'El camp :attribute només pot contenir lletres, números, guions i guions baixos.',
    'alpha_num' => 'El camp :attribute només pot contenir lletres i números.',
    'array' => 'El camp :attribute ha de ser un array.',
    'ascii' => 'El camp :attribute només pot contenir caràcters alfanumèrics d\'un sol byte i símbols.',
    'before' => 'El camp :attribute ha de ser una data anterior a :date.',
    'before_or_equal' => 'El camp :attribute ha de ser una data anterior o igual a :date.',
    'between' => [
        'array' => 'El camp :attribute ha de tenir entre :min i :max elements.',
        'file' => 'El camp :attribute ha de tenir entre :min i :max kilobytes.',
        'numeric' => 'El camp :attribute ha d\'estar entre :min i :max.',
        'string' => 'El camp :attribute ha de tenir entre :min i :max caràcters.',
    ],
    'boolean' => 'El camp :attribute ha de ser vertader o fals.',
    'can' => 'El camp :attribute conté un valor no autoritzat.',
    'confirmed' => 'La confirmació del camp :attribute no coincideix.',
    'current_password' => 'La contrasenya és incorrecta.',
    'date' => 'El camp :attribute no és una data vàlida.',
    'date_equals' => 'El camp :attribute ha de ser una data igual a :date.',
    'date_format' => 'El camp :attribute ha de coincidir amb el format :format.',
    'decimal' => 'El camp :attribute ha de tenir :decimal llocs decimals.',
    'declined' => 'El camp :attribute ha de ser rebutjat.',
    'declined_if' => 'El camp :attribute ha de ser rebutjat quan :other és :value.',
    'different' => 'El camp :attribute i :other han de ser diferents.',
    'digits' => 'El camp :attribute ha de tenir :digits dígits.',
    'digits_between' => 'El camp :attribute ha de tenir entre :min i :max dígits.',
    'dimensions' => 'El camp :attribute té dimensions d\'imatge no vàlides.',
    'distinct' => 'El camp :attribute té un valor duplicat.',
    'doesnt_end_with' => 'El camp :attribute no ha de finalitzar amb cap dels següents valors: :values.',
    'doesnt_start_with' => 'El camp :attribute no ha de començar amb cap dels següents valors: :values.',
    'email' => 'El camp :attribute ha de ser una adreça de correu electrònic vàlida.',
    'ends_with' => 'El camp :attribute ha de finalitzar amb un dels següents valors: :values.',
    'enum' => 'El :attribute seleccionat és invàlid.',
    'exists' => 'El :attribute seleccionat és invàlid.',
    'extensions' => 'El camp :attribute ha de tenir una de les següents extensions: :values.',
    'file' => 'El camp :attribute ha de ser un fitxer.',
    'filled' => 'El camp :attribute ha de tenir un valor.',
    'gt' => [
        'array' => 'El camp :attribute ha de tenir més de :value elements.',
        'file' => 'El camp :attribute ha de ser més gran que :value kilobytes.',
        'numeric' => 'El camp :attribute ha de ser més gran que :value.',
        'string' => 'El camp :attribute ha de tenir més de :value caràcters.',
    ],
    'gte' => [
        'array' => 'El camp :attribute ha de tenir :value elements o més.',
        'file' => 'El camp :attribute ha de ser més gran o igual que :value kilobytes.',
        'numeric' => 'El camp :attribute ha de ser més gran o igual que :value.',
        'string' => 'El camp :attribute ha de tenir :value caràcters o més.',
    ],
    'hex_color' => 'El camp :attribute ha de ser un color hexadecimal vàlid.',
    'image' => 'El camp :attribute ha de ser una imatge.',
    'in' => 'El :attribute seleccionat és invàlid.',
    'in_array' => 'El camp :attribute ha d\'existir a :other.',
    'integer' => 'El camp :attribute ha de ser un nombre enter.',
    'ip' => 'El camp :attribute ha de ser una adreça IP vàlida.',
    'ipv4' => 'El camp :attribute ha de ser una adreça IPv4 vàlida.',
    'ipv6' => 'El camp :attribute ha de ser una adreça IPv6 vàlida.',
    'json' => 'El camp :attribute ha de ser una cadena JSON vàlida.',
    'lowercase' => 'El camp :attribute ha d\'estar en minúscules.',
    'lt' => [
        'array' => 'El camp :attribute ha de tenir menys de :value elements.',
        'file' => 'El camp :attribute ha de ser més petit que :value kilobytes.',
        'numeric' => 'El camp :attribute ha de ser menor que :value.',
        'string' => 'El camp :attribute ha de tenir menys de :value caràcters.',
    ],
    'lte' => [
        'array' => 'El camp :attribute no ha de tenir més de :value elements.',
        'file' => 'El camp :attribute ha de ser més petit o igual que :value kilobytes.',
        'numeric' => 'El camp :attribute ha de ser menor o igual que :value.',
        'string' => 'El camp :attribute ha de tenir :value caràcters o menys.',
    ],
    'mac_address' => 'El camp :attribute ha de ser una adreça MAC vàlida.',
    'max' => [
        'array' => 'El camp :attribute no ha de tenir més de :max elements.',
        'file' => 'El camp :attribute no ha de ser més gran que :max kilobytes.',
        'numeric' => 'El camp :attribute no ha de ser més gran que :max.',
        'string' => 'El camp :attribute no ha de ser més gran que :max caràcters.',
    ],
    'max_digits' => 'El camp :attribute no ha de tenir més de :max dígits.',
    'mimes' => 'El camp :attribute ha de ser un fitxer de tipus: :values.',
    'mimetypes' => 'El camp :attribute ha de ser un fitxer de tipus: :values.',
    'min' => [
        'array' => 'El camp :attribute ha de tenir com a mínim :min elements.',
        'file' => 'El camp :attribute ha de ser d\'almenys :min kilobytes.',
        'numeric' => 'El camp :attribute ha de ser d\'almenys :min.',
        'string' => 'El camp :attribute ha de tenir com a mínim :min caràcters.',
    ],
    'min_digits' => 'El camp :attribute ha de tenir com a mínim :min dígits.',
    'missing' => 'El camp :attribute ha d\'estar absent.',
    'missing_if' => 'El camp :attribute ha d\'estar absent quan :other és :value.',
    'missing_unless' => 'El camp :attribute ha d\'estar absent a menys que :other sigui :value.',
    'missing_with' => 'El camp :attribute ha d\'estar absent quan :values està present.',
    'missing_with_all' => 'El camp :attribute ha d\'estar absent quan :values està present.',
    'multiple_of' => 'El camp :attribute ha de ser un múltiple de :value.',
    'not_in' => 'El :attribute seleccionat és invàlid.',
    'not_regex' => 'El format del camp :attribute no és vàlid.',
    'numeric' => 'El camp :attribute ha de ser un nombre.',
    'password' => [
        'letters' => 'El camp :attribute ha de contenir almenys una lletra.',
        'mixed' => 'El camp :attribute ha de contenir almenys una lletra majúscula i una minúscula.',
        'numbers' => 'El camp :attribute ha de contenir almenys un número.',
        'symbols' => 'El camp :attribute ha de contenir almenys un símbol.',
        'uncompromised' => 'El :attribute donat ha aparegut en una filtració de dades. Si us plau, escolliu un :attribute diferent.',
    ],
    'present' => 'El camp :attribute ha d\'estar present.',
    'present_if' => 'El camp :attribute ha d\'estar present quan :other és :value.',
    'present_unless' => 'El camp :attribute ha d\'estar present a menys que :other sigui :value.',
    'present_with' => 'El camp :attribute ha d\'estar present quan :values està present.',
    'present_with_all' => 'El camp :attribute ha d\'estar present quan :values està present.',
    'prohibited' => 'El camp :attribute està prohibit.',
    'prohibited_if' => 'El camp :attribute està prohibit quan :other és :value.',
    'prohibited_unless' => 'El camp :attribute està prohibit a menys que :other estigui en :values.',
    'prohibits' => 'El camp :attribute prohibeix que :other estigui present.',
    'regex' => 'El format del camp :attribute no és vàlid.',
    'required' => 'El camp :attribute és obligatori.',
    'required_array_keys' => 'El camp :attribute ha de contenir entrades per a: :values.',
    'required_if' => 'El camp :attribute és obligatori quan :other és :value.',
    'required_if_accepted' => 'El camp :attribute és obligatori quan :other és acceptat.',
    'required_unless' => 'El camp :attribute és obligatori a menys que :other estigui a :values.',
    'required_with' => 'El camp :attribute és obligatori quan :values està present.',
    'required_with_all' => 'El camp :attribute és obligatori quan :values està present.',
    'required_without' => 'El camp :attribute és obligatori quan :values no està present.',
    'required_without_all' => 'El camp :attribute és obligatori quan cap de :values està present.',
    'same' => 'El camp :attribute i :other han de coincidir.',
    'size' => [
        'array' => 'El camp :attribute ha de contenir :size elements.',
        'file' => 'El camp :attribute ha de ser de :size kilobytes.',
        'numeric' => 'El camp :attribute ha de ser :size.',
        'string' => 'El camp :attribute ha de tenir :size caràcters.',
    ],
    'starts_with' => 'El camp :attribute ha d\'iniciar amb un dels següents valors: :values.',
    'string' => 'El camp :attribute ha de ser una cadena.',
    'timezone' => 'El camp :attribute ha de ser una zona horària vàlida.',
    'unique' => 'El :attribute ja ha estat pres.',
    'uploaded' => 'El :attribute no s\'ha pogut carregar.',
    'uppercase' => 'El camp :attribute ha d\'estar en majúscules.',
    'url' => 'El camp :attribute ha de ser una URL vàlida.',
    'ulid' => 'El camp :attribute ha de ser un ULID vàlid.',
    'uuid' => 'El camp :attribute ha de ser un UUID vàlid.',

    /*
    |--------------------------------------------------------------------------
    | Línies de Llenguatge de Validació Personalitzades
    |--------------------------------------------------------------------------
    |
    | Aquí podeu especificar missatges de validació personalitzats per a atributs utilitzant el
    | convenció "attribute.rule" per a nomenar les línies. Això fa que sigui ràpid
    | especificar una línia de llenguatge personalitzada específica per a una regla d'atribut determinada.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'missatge-personalitzat',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atributs de Validació Personalitzats
    |--------------------------------------------------------------------------
    |
    | Les següents línies de llenguatge s'utilitzen per intercanviar els nostres marcadors de posició d'atribut
    | amb alguna cosa més fàcil de llegir com "Adreça de correu electrònic" en lloc de "correu electrònic". Això simplement ens ajuda a fer el nostre missatge més expressiu.
    |
    */

    'attributes' => [],

];
