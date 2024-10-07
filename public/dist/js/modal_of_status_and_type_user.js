var userIdToSubmit; // Variável global para armazenar o ID do usuário a ser submetido

// Função para exibir o modal de confirmação
function showConfirmationModal_permission(userId) {
    userIdToSubmit = userId; // Armazenar o ID do usuário
    $('#confirmationModal').modal('show');
}

// Função para executar a ação após a confirmação
function executeAction() {
    // Obtenha o ID do usuário armazenado globalmente
    var userId = userIdToSubmit;
    // Obtenha o valor da permissão selecionada
    var permissionSelect = $('.permission-form[data-user-id="' + userId + '"] .permission-select');
    var permissionId = permissionSelect.val();
    // Adicione este log para verificar o ID antes de enviar
    console.log('UserID to Submit:', userId);
    console.log('PermissionID to Submit:', permissionId);

    // Submeta o formulário correspondente ao ID do usuário
    $('.permission-form[data-user-id="' + userId + '"]').submit();
    // Feche o modal
    $('#confirmationModal').modal('hide');
}


var userIdToSubmit; // Variável global para armazenar o ID do usuário a ser submetido

// Função para exibir o modal de confirmação
function showConfirmationModal_status(userId) {
    userIdToSubmit = userId; // Armazenar o ID do usuário
    $('#confirmationModal-status').modal('show');
}

// Função para executar a ação após a confirmação
function executeAction_status() {
    // Obtenha o ID do usuário armazenado globalmente
    var userId = userIdToSubmit;
    // Obtenha o valor do status selecionado
    var statusSelect = $('.status-form[data-user-id="' + userId + '"] .user-type-select');
    var statusId = statusSelect.val();
    // Adicione este log para verificar o ID antes de enviar
    console.log('UserID to Submit:', userId);
    console.log('StatusID to Submit:', statusId);

    // Submeta o formulário correspondente ao ID do usuário
    $('.status-form[data-user-id="' + userId + '"]').submit();
    // Feche o modal
    $('#confirmationModal-status').modal('hide');
}








// =========== SUBMISAO DE FORM ELIMINA ============
function submitForm(formId) {
    document.getElementById(formId).submit();
}