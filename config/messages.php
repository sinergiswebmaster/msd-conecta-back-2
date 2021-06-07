<?php

return [

    'login' => [
        'error' => 'El usuario no éxiste',
        'success' => 'Acceso concedido.'
    ],

    'name' => [
        'required' => 'El nombre es obligatorio.',
    ],

    'last_name' => [
        'required' => 'El apellido paterno es obligatorio.',
    ],

    'second_last_name' => [
        'required' => 'El apellido materno es obligatorio.',
    ],

    'email' => [
        'required' => 'El email es obligatorio.',
        'email' => "El formato del email es incorrecto.",
        'confirmed' => "Los emails no coinciden.",
        'exists' => "El email no existe.",
        'unique' => "El email ya esta en uso."
    ],

    'profession_id' => [
        'required' => 'La profesión es obligatoria.',
    ],
    'specialty_id' => [
        'required' => 'La especialidad es obligatoria.',
    ],
    'license' => [
        'required' => 'La cédula es obligatoria.',
    ],
    'phone' => [
        'required' => 'El celular es obligatorio.',
    ],

    'institutional_email' => [
        // 'required' => 'El email institucional es obligatorio',
        'email' => "El formato del email institucional es incorrecto",
    ],

    'extension' => [
        'required' => 'La extensión es obligatoria',
    ],


    'password' => [
        'required' => "La contraseña es obligatoria",
        'confirmed' => "Las contraseñas no coinciden",
        'min' => "Las contraseña debe tener un mínimo de 4 caracteres"
    ],

    'employee_number' => [
        'required' => 'El número de empleado es obligatorio.',
    ],

    'medical_unity_name' => [
        'required' => 'El nombre de la unidad médica es obligatoria.',
    ],


    'delegation_name' => [
        'required' => 'El nombre de la delegación es obligatoria.',
    ],


    'office_phone' => [
        'required' => 'El teléfono de la oficina es obligatorio.',
    ],

    'cellphone' => [
        'required' => 'El teléfono celular es obligatorio.',
    ],

    'rfc' => [
        'required' => 'El rfc es obligatorio.',
    ],

    'position' => [
        'required' => 'El cargo es obligatoria.',
    ],

    'orders' => [
        'required' => 'El pedido es obligatorio.',
    ],


    'register' => [
        'success' => 'Registrado con éxito',
    ],

    'cannot' => [
        'enter' => 'Te recomendamos ingresar a tu capacitación en el horario establecido (zona horaria Ciudad de México), ya que de no ser así únicamente podrás entrar hasta el miércoles 24 de marzo.'
    ],

    'event' => [
        'has_started' => 'Lo sentimos el evento ha empezado. Ùnicamente podrás entrar hasta el miércoles 24 de marzo.'
    ],

    'too_late' => [
        'enter' => 'Se ha registrado con éxito, pero es necesario entrar mañana a la primera sesión'
    ],

    'next' => [
        'session' => 'Se ha registrado con éxito, pero es necesario entrar a la siguiente sesión'
    ],

    'employee_number' => [
        'required' => 'El número de empleado es obligatorio'
    ],

    'wrong' => [
        'order' => 'La opción válida es "Genero y Autorizo pedidos en platforma"'
    ],

    'department' => [
        'required' => 'El departamento es obligatorio'
    ],

    'agree_terms' => [
        'accepted' => 'Debe aceptar los términos y condiciones de uso de MSD'
    ],

    'agree_privacy' => [
        'accepted' => 'Debe aceptar el aviso de privacidad'
    ]

];
