/**
 * Created by paulo on 06/07/14.
 */
$('.form').validate({
    rules: {
        nome: {
            minlength: 3,
            maxlength: 255,
            required: true
        },
        cpf: {
            required: true
        },
        email: {
            required: true,
            email: true
        },
        assunto: {
            required: true
        },
        menssagem: {
            required: true
        },
        login: {
            required: true
        },
        loginPassword: {
            required: true
        }
    },
    messages: {
        nome: {
            required: 'Nome é obrigatório!'
        },
        cpf: {
            required: 'CPF é obrigatótio!'
        },
        email: {
            required: 'Email é obrigatório!',
            email: 'Entre com um email válido!'
        },
        assunto: {
            required: 'Assunto é obrigatório!'
        },
        menssagem: {
            required: 'Menssagem é obrigatório!'
        },
        login: {
            required: 'Login é obrigatório!'
        },
        loginPassword: {
            required: 'Senha é obrigatório!'
        }
    },
    highlight: function (element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function (element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function (error, element) {
        if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});

function passwordUser(status) {
    if (status == 0) {
        document.getElementById('password').disabled = "disabled";
    }
    if (status == 1 || status == 2) {
        document.getElementById('password').disabled = false;
    }
}