<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'El :attribute debe ser aceptado.',
    'accepted_if' => 'El :attribute debe aceptarse cuando :other sea :value.',
    'active_url' => 'El :attribute no es una URL válida.',
    'after' => 'El :attribute debe ser una fecha después de :date.',
    'after_or_equal' => 'El :attribute debe ser una fecha después o igual a :date.',
    'alpha' => 'El :attribute debe contener solo letras.',
    'alpha_dash' => 'El :attribute solo debe contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El :attribute solo debe contener letras y números.',
    'array' => 'El atributo :attribute debe ser un array.',
    'before' => 'El atributo :attribute debe ser una fecha anterior a :date.',
    'before_or_equal' => 'El atributo :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'numeric' => 'El atributo :attribute debe estar entre :min y :max.',
        'file' => 'El atributo :attribute debe estar entre :min y :max kilobytes.',
        'string' => 'El atributo :attribute debe estar entre :min y :max caracteres.',
        'array' => 'El atributo :attribute debe tener entre :min y :max items.',
    ],
    'boolean' => 'El atributo :attribute debe ser verdadero o falso.',
    'confirmed' => 'la confirmación del atributo :attribute no coincide.',
    'current_password' => 'La contraseña es incorrecta.',
    'date' => 'El atributo :attribute no es una fecha válida.',
    'date_equals' => 'El atributo :attribute debe ser una fecha igual a :date.',
    'date_format' => 'El atributo :attribute no coincide con el formato :format.',
    'declined' => 'El atributo :attribute debe ser rechazado.',
    'declined_if' => 'El atributo :attribute debe rechazarse cuando :other es :value.',
    'different' => 'El atributo :attribute y atributo :other debe ser diferente.',
    'digits' => 'El atributo :attribute debe ser :digits digitos.',
    'digits_between' => 'El atributo :attribute debe estar entre :min y :max digitos.',
    'dimensions' => 'El atributo :attribute tiene dimensiones de imagen no válidas.',
    'distinct' => 'El atributo :attribute tiene un valor duplicado.',
    'email' => 'El atributo :attribute debe ser una dirección de correo electrónico válida.',
    'ends_with' => 'El atributo :attribute debe terminar con unos de los siguientes valores: :values.',
    'enum' => 'El atributo seleccionado :attribute es invalido.',
    'exists' => 'El atributo seleccionado :attribute es invalido.',
    'file' => 'El campo :attribute debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'numeric' => 'El atributo :attribute debe ser mayor que :value.',
        'file' => 'El atributo :attribute debe ser mayor que :value kilobytes.',
        'string' => 'El atributo :attribute debe ser mayor que :value caracteres.',
        'array' => 'El atributo :attribute debe tener más de :value items.',
    ],
    'gte' => [
        'numeric' => 'El atributo :attribute debe ser mayor o igual a :value.',
        'file' => 'El atributo :attribute debe ser mayor o igual a :value kilobytes.',
        'string' => 'El atributo :attribute debe ser mayor o igual a :value caracteres.',
        'array' => 'El atributo :attribute debe tener :value items o más.',
    ],
    'image' => 'El atributo :attribute debe ser una imagen.',
    'in' => 'El atributo :attribute seleccionado es invalido.',
    'in_array' => 'El atributo :attribute no existe en el atributo :other.',
    'integer' => 'El atributo :attribute debe ser un entero.',
    'ip' => 'El atributo :attribute debe ser una dirección IP válida.',
    'ipv4' => 'El atributo :attribute debe ser una dirección IPv4 válida.',
    'ipv6' => 'El atributo :attribute debe ser una dirección IPv6 válida.',
    'mac_address' => 'El atributo :attribute debe ser una dirección MAC válida.',
    'json' => 'El atributo :attribute debe ser una cadena JSON válida.',
    'lt' => [
        'numeric' => 'El atributo :attribute debe ser menor que :value.',
        'file' => 'El atributo :attribute debe ser menor que :value kilobytes.',
        'string' => 'El atributo :attribute debe ser menor que :value caracteres.',
        'array' => 'El atributo :attribute debe tener menos de :value items.',
    ],
    'lte' => [
        'numeric' => 'El atributo :attribute debe ser menor o igual a :value.',
        'file' => 'El atributo :attribute debe ser menor o igual a :value kilobytes.',
        'string' => 'El atributo :attribute debe ser menor o igual a :value carcateres.',
        'array' => 'El atributo :attribute no debe tener más de :value items.',
    ],
    'max' => [
        'numeric' => 'El atributo :attribute no debe ser mayor a :max.',
        'file' => 'El atributo :attribute no debe ser mayor a :max kilobytes.',
        'string' => 'El atributo :attribute no debe ser mayor a :max caracteres.',
        'array' => 'El atributo :attribute no debe tener más de :max items.',
    ],
    'mimes' => 'El atributo :attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => 'El atributo :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'numeric' => 'El atributo :attribute al menos debe ser :min.',
        'file' => 'El atributo :attribute al menos debe tener :min kilobytes.',
        'string' => 'El atributo :attribute al menos debe tener :min caracteres.',
        'array' => 'El atributo :attribute debe tener al menos :min items.',
    ],
    'multiple_of' => 'El atributo :attribute debe ser múltiplo de :value.',
    'not_in' => 'El atributo seleccionado :attribute es invalido.',
    'not_regex' => 'El formato del atributo :attribute es invalido.',
    'numeric' => 'El atributo :attribute debe ser un número.',
    'password' => 'La contraseña es incorrecta.',
    'present' => 'El atributo :attribute debe estar presente.',
    'prohibited' => 'El atributo :attribute está prohibido.',
    'prohibited_if' => 'El atributo :attribute es prohibido cuando :other es :value.',
    'prohibited_unless' => 'El atributo :attribute está prohibido a no ser que :other este en :values.',
    'prohibits' => 'El atributo :attribute prohíbe que :other estén presentes.',
    'regex' => 'El formato del atributo :attribute es invalido.',
    'required' => 'El atributo :attribute es requerido.',
    'required_if' => 'El atributo :attribute es requerido cuando el atributo :other es :value.',
    'required_unless' => 'El atributo :attribute es requerido a menos que el atributo :other esté en :values.',
    'required_with' => 'El campo :attribute es requerido cuando :values está presente.',
    'required_with_all' => 'El campo :attribute es requerido cuando :values están presentes.',
    'required_without' => 'El campo :attribute es requerido cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es requerido cuando ningun :values estén presentes.',
    'same' => 'El atributo :attribute y el atributo :other deben coincidir.',
    'size' => [
        'numeric' => 'El atributo :attribute debe ser :size.',
        'file' => 'El atributo :attribute debe tener :size kilobytes.',
        'string' => 'El atributo :attribute debe tener :size caracteres.',
        'array' => 'El atributo :attribute debe contener :size items.',
    ],
    'starts_with' => 'El atributo :attribute debe comenzar con uno de los siguientes valores: :values.',
    'string' => 'El atributo :attribute debe ser un texto.',
    'timezone' => 'El atributo :attribute debe tener una zona horaria valida.',
    'unique' => 'El atributo :attribute ya se ha tomado.',
    'uploaded' => 'El atributo :attribute no se pudo cargar.',
    'url' => 'El atributo :attribute debe tener una URL valida.',
    'uuid' => 'El atributo :attribute debe tener un UUID valido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
