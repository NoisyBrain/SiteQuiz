
function confirmar(erro){
    var divErro = document.getElementById(erro);
    var F_divErro = divErro.parentNode;
    F_divErro.removeChild(divErro);
    var G_divErro = F_divErro.parentNode;
    G_divErro.removeChild(F_divErro);
}