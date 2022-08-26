function limpaCamposFormulario()
{
    $(".invalid-feedback").hide();
    $(".campoFormulario").val("");
    $(".campoFormularioCheckBox").prop("checked", false)
}